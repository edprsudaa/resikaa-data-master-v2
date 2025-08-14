var v = new Vue({
    el: '#app',
    data: {
        url: 'http://localhost/RSUD/akuntansi-rsud-app/web/',
        results: [],
        emptyResult: false,
        totalAkuns: 0,
        //pagination
        currentPage: 0,
        rowCountPage: 400,
        totalUsers: 0,
        pageRange: 2
    },
    mounted: function () {
        this.loadData();
    },
    methods: {
        loadData: function () {

            axios.get(this.url + 'data-akun/get-data-akun').then(function (response) {
                if (response.data.results == null) {
                    v.noResult()
                } else {
                    v.getData(response.data.results);

                }
            })
        },
        getData(results) {
            v.emptyResult = false; // become false if has a record
            v.totalAkuns = results.length //get total of user
            v.results = results.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

        },
        noResult() {

            v.emptyResult = true; // become true if the record is empty, print 'No Record Found'
            v.data = null
            v.totalAkuns = 0 //remove current page if is empty

        },

    }

});