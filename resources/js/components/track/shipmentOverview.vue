<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="ml-2">
                            Shipments Overview  :  9e606e6b-44a4-4a4e-a309-cc70ddd3a103
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <table>
                        <tr>
                            <th style="width: 7%">ref ID</th>
                            <th style="width: 10%">Contact Persoon</th>
                            <th style="width: 13%">verstuurder</th>
                            <th style="width: 5%">Land</th>
                            <th style="width: 20%">Aangemaakt</th>
                            <th style="width: 15%">Locatie</th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 10%"></th>
                        </tr>
                        <tr v-for="shipment in shipments.data" v-bind:id="'shipment_' + shipment.id" :key="shipment.id">
                            <td  >{{ shipment.reference }}</td>
                            <td  >{{ shipment.receiver_contact.name }}</td>
                            <td  >{{ shipment.brand.name }}</td>
                            <td  >{{ shipment.receiver_contact.country }}</td>
                            <td  >{{ shipment.receiver_contact.created | moment("dddd DD MMMM YYYY, HH:mm")  }}</td>
                            <td  >{{ shipment.receiver_contact.street }}  {{ shipment.receiver_contact.housenumber }} {{ shipment.receiver_contact.postalcode }} {{ shipment.receiver_contact.locality }} </td>
                            <td  >{{ shipment.status }}</td>

                            <td  ><a class="btn btn-primary btn-block" :href="`http://track-n-label.test/track/shipmentView/` + shipment.id + `/` + companyID ">
                                Detail Bekijken
                            </a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>
<script type="application/javascript">

export default {
    props: [],
    components: {

    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            shipments: {},
            companyID: '9e606e6b-44a4-4a4e-a309-cc70ddd3a103'
        }
    },
    mounted() {
        axios.post('http://track-n-label.test/track/api/shipment/index', {
            _token: this.csrf,
            companyID: this.companyID
        }).then(response => {
            this.shipments = response.data;
        });
    },
    methods: {

    }
}
</script>
