Vue.http.options.emulateJSON = true;

var app = new Vue({
    el: '#app',
    data: {
        apiUrl : '/api/1/apps',
        idToDelete: '',
        deleteMessage: '',
        postMessage: '',
        postName : 'test name',
        postCategory: 'Books',
        postLink: 'http://testlink.com',
        postRank: '10',
        postImage: 'http://test/image.jpg'
    },
    methods: {

        deleteFormInit: function (event) {

            var id = $(event.target).closest('.delete-link').attr("data-id");

            this.idToDelete = id;
            this.deleteMessage = "";

            $(window).scrollTo($("#deleteFieldset"), 200);
            $('#deleteFieldset').addClass("highlight");
            setTimeout(function () {
                $("#deleteFieldset").removeClass("highlight");
            }, 2000);
        },

        deleteFormSubmit: function () {
            this.$http.delete(this.apiUrl + "/" + this.idToDelete).then(function (data) {
                this.deleteMessage = "Object " + data.body.objectID + " deleted!";
            }, function (data) {
                this.deleteMessage = "Error : " + data.statusText + "- code : " + data.status;
            });
        },

        postFormSubmit: function () {
            var postData = {
                name: this.postName,
                category: this.postCategory,
                rank: this.postRank,
                link: this.postLink,
                image: this.postImage
            };

            this.$http.post(this.apiUrl, postData).then(function (data) {
                this.postMessage = "Object " + data.body.objectID + " added!";
            }, function (data) {
                this.postMessage = "Error : " + data.statusText + "- code : " + data.status;
            });
        }
    }
});

var options = {
    appId: appConfig.appId,
    apiKey: appConfig.apiKey,
    indexName: appConfig.indexName,
    urlSync: true
};

const search = instantsearch(options);

// initialize RefinementList
search.addWidget(
    instantsearch.widgets.refinementList({
        container: '#refinement-list',
        attributeName: 'category'
    })
);

// initialize SearchBox
search.addWidget(
    instantsearch.widgets.searchBox({
        container: '#search-box',
        placeholder: 'Search for products'
    })
);

// initialize hits widget
search.addWidget(
    instantsearch.widgets.hits({
        container: '#hits',
        templates: {
            empty: 'No results',
            item: '<div class="row delete-link" data-id="{{objectID}}">' +
            '<div class="cell name">{{{_highlightResult.name.value}}}</div>' +
            '<div class="cell category">{{{_highlightResult.category.value}}}</div>' +
            '</div>'
        }
    })
);
search.addWidget(
    instantsearch.widgets.pagination({
        container: '#pagination-container',
        maxPages: 20,
        // default is to scroll to 'body', here we disable this behavior
        scrollTo: false,
        showFirstLast: false,
    })
);
search.addWidget(
    instantsearch.widgets.pagination({
        container: '#pagination-container-bottom',
        maxPages: 20,
        // default is to scroll to 'body', here we disable this behavior
        scrollTo: false,
        showFirstLast: false,
    })
);

search.addWidget(
    instantsearch.widgets.sortBySelector({
            container: '#sorter',
            indices: [
                {name: appConfig.indexName, label: 'Most relevant'},
                {name: 'replic1', label: 'by ascending name'},
                {name: 'replic2', label: 'by descending name'}
            ]
        }
    ));

search.start();
