<template>
    <div class="main-container">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <h4>Pakketje : {{ shipment.data.reference }} - {{ shipment.data.brand.name }}</h4>
                </div>
                <td  >{{ shipment.data.reference }}</td>
                <td  >{{ shipment.data.receiver_contact.name }}</td>
                <td  >{{ shipment.data.brand.name }}</td>
                <td  >{{ shipment.data.receiver_contact.country }}</td>
                <td  >{{ shipment.data.receiver_contact.created | moment("dddd DD MMMM YYYY, HH:mm")  }}</td>
                <td  >{{ shipment.data.receiver_contact.street }}  {{ shipment.data.receiver_contact.housenumber }} {{ shipment.data.receiver_contact.postalcode }} {{ shipment.data.receiver_contact.locality }} </td>
                <td  >{{ shipment.data.status }}</td>

                <div class="table-responsive col-sm-12 col-md-12">

                    <table>
                        <tr>
                            <th style="width:25%" >Naam beschrijving</th>
                            <th style="width:65%" ></th>
                            <th style="width:5%" class="text-right" >Quantiteit</th>
                            <th style="width:5%" class="text-right" >Prijs</th>
                        </tr>
                        <hr>
                       <tr><!--  for loop if actual products -->
                            <td  >{{ shipment.data.product.name }}</td>
                            <td  ></td>
                            <td  >1</td>
                            <td  >euro 4</td>
                        </tr>
                    </table>
                </div>
                <h5>Status updates</h5>
                <div class="table-responsive col-sm-12 col-md-12">

                    <table>
                        <tr>
                            <th style="width:33%" >Naam</th>
                            <th style="width:33%" >Beschrijving</th>
                            <th style="width:33%" >Tijdstip</th>
                        </tr>
                        <hr>
                        <tr v-for="event in shipment.data.events" v-bind:id="'user_' + event.id" :key="event.id">
                            <td style="width:33%" >{{ event.creator_name }}</td>
                            <td style="width:33%" >{{ event.message }}</td>
                            <td style="width:33%" >{{ event.created | moment("dddd DD MMMM YYYY, HH:mm")  }}</td>
                        </tr>
                    </table>
                </div>

                <a class="btn btn-primary btn-block" v-on:click="downloadPdf('pakbon ' +  shipment.data.reference  + ' ' + shipment.data.brand.name)">
                    Pakbon Downloaden
                </a>
            </div>
        </div>

    </div>

</template>
<script type="application/javascript">

export default {
    props: ['shipment'],
    components: {

    },
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            products: this.shipment.data.product ?? {},
        }
    },
    mounted() {

    },
    methods: {
        downloadPdf(fileName) {
            axios.post('http://track-n-label.test/track/downloadPDF', {
                _token: this.csrf,
                shipment: this.shipment.data,
            }, {responseType: 'blob'}).then(function (response) {
                const blob = new Blob([response.data], {type: 'application/pdf'});
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = fileName + '.pdf';
                link.click();
                URL.revokeObjectURL(link.href);

            }.bind(this)).catch(function (error) {
                console.log('Something went wrong, replace with popup?')
                console.log(error)
            }.bind(this));
        },
    }
}
</script>
