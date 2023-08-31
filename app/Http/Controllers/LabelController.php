<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LabelController extends Controller
{
    protected string $base_url;
    protected string $auth;
    protected string $api_user;

    public function __construct()
    {
        $this->base_url = getenv('QLS_API_BASE_URI'); //https://api.pakketdienstqls.nl/
        $this->auth = getenv('QLS_API_PASS');
        $this->api_user = getenv('QLS_API_USER');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index() : View
    {
        return view('track.index');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function overviewShipment(){
        // in here I will get shipment, add in a way to print it as an actual, PDF. Using previously created assets.
        return view('track.shipmentOverview');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function viewShipment(string $id , string $companyID, GuzzleClient $client){
        try {

            $guzzleResponse = $client->get($this->base_url . 'companies/' . $companyID . '/shipments/' . $id,
                [
                    'auth' => [
                        $this->api_user,
                        $this->auth
                    ]
                ]
            );

            if ($guzzleResponse->getStatusCode() === 200) {
                return view('track.shipmentView')->with([
                    'shipment'         => $guzzleResponse->getBody(),]
                );
            }

            return back()->with('danger', __("No results found"));
        } catch (Throwable $exception) {
            return back()->with('danger', __("Something went wrong"));
        }

    }

    /**
     * This method gives me multiple companies from API needs, ID.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Psr\Http\Message\StreamInterface
     */
    public function getOverviewShipments(Request $request, GuzzleClient $client)
    {
        try {
            $guzzleResponse = $client->get($this->base_url . 'companies/' . $request->companyID . '/shipments', // Todo: make 1 function with addition value to select for 'shipments, or the likes..'
                [
                    'auth' => [
                        $this->api_user,
                        $this->auth
                    ]
                ]
            );

            if ($guzzleResponse->getStatusCode() === 200) {
                return $guzzleResponse->getBody();
            }

            return back()->with('danger', __("No results found"));
        } catch (Throwable $exception) {
            return back()->with('danger', __("Something went wrong"));
        }
    }

    /**
     * This method gives me multiple companies from API needs, ID.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Psr\Http\Message\StreamInterface
     */
    public function getShipment(GuzzleClient $client)
    {
        try {
            $guzzleResponse = $client->get($this->base_url . 'companies',
                [
                    'auth' => [
                        $this->api_user,
                        $this->auth
                    ]
                ]
            );

            if ($guzzleResponse->getStatusCode() === 200) {
                return $guzzleResponse->getBody();
            }

            return back()->with('danger', __("No results found"));
        } catch (Throwable $exception) {
            return back()->with('danger', __("Something went wrong"));
        }
    }


    /**
     * This method gives me multiple companies from API needs, ID.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Psr\Http\Message\StreamInterface
     */
    public function getCompanies(GuzzleClient $client)
    {
        try {
            $guzzleResponse = $client->get($this->base_url . 'companies',
                [
                    'auth' => [
                        $this->api_user,
                        $this->auth
                    ]
                ]
            );

            if ($guzzleResponse->getStatusCode() === 200) {
                return $guzzleResponse->getBody();
            }

            return back()->with('danger', __("No results found"));
        } catch (Throwable $exception) {
            return back()->with('danger', __("Something went wrong"));
        }
    }

    /**
     * This method gives me a Company from API needs ID.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Psr\Http\Message\StreamInterface
     */
    public function getCompany(Request $request,  GuzzleClient $client)
    {
        try {
            $guzzleResponse = $client->get($this->base_url . 'company/' . $request->companyID . '/product',
                [
                    'auth' => [
                        $this->api_user,
                        $this->auth
                    ]
                ]
            );

            if ($guzzleResponse->getStatusCode() === 200) {
                return $guzzleResponse->getBody();
            }

            return back()->with('danger', __("No results found"));
        } catch (Throwable $exception) {
            return back()->with('danger', __("Something went wrong"));
        }
    }

    /**
     * This method gives me a Company from API needs ID.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Psr\Http\Message\StreamInterface
     */
    public function createShipment(Request $request,  GuzzleClient $client)
    {
        try {
            $guzzleResponse = $client->post($this->base_url . 'company/' . $request->companyID . '/shipment/create',
                [
                    'auth' => [
                        $this->api_user,
                        $this->auth
                    ],
                    'json'    => [
                        'shipment' => $request->shipment,
                    ],
                ]
            );

            if ($guzzleResponse->getStatusCode() === 200) {
                return $guzzleResponse->getBody();
            }

            return back()->with('danger', __("No results found"));
        } catch (Throwable $exception) {
            return back()->with('danger', __("Something went wrong"));
        }
    }

    /**
     * Generates and sends a PDF.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getPDF(Request $request){

        $pdf = PDF::loadView('pdf.trackLabel', [
            'title'    => $request->shipment['reference'],
            'shipment' => $request->shipment
        ]);

        return $pdf->download();
    }

    public function test(){

        return view('pdf.trackLabel', [
            'title'                         => 'Pakbon',
        ]);
    }


}
