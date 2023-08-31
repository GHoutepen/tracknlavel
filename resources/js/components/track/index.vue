<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-title ml-2">
                            Company overview  :  9e606e6b-44a4-4a4e-a309-cc70ddd3a103
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">

            <div class="table-responsive">

                <table>
                    <tr>
                        <th>Name</th>
                        <th>specifications</th>
                        <th>Type</th>
                    </tr>
                    <tr v-for="invoice in company.data" v-bind:id="'user_' + invoice.id" :key="invoice.id">
                        <td>{{ invoice.name }}</td>
                        <td>{{ invoice.specifications }}</td>
                        <td>{{ invoice.type }}</td>
                    </tr>
                </table>
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
            company: {}
        }
    },
    mounted() {
        axios.post('http://track-n-label.test/track/api/getCompany', {
            _token: this.csrf,
            companyID: '9e606e6b-44a4-4a4e-a309-cc70ddd3a103'
        }).then(response => {
            this.company = response.data;
        });
    },
    methods: {
        downloadPdf(fileName) {
            axios.post('http://track-n-label.test/track/downloadPDF', {
                _token: this.csrf,
                obvVar: 'becomes Request',
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
