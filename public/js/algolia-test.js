var app = new Vue({
    el: '#app',
    methods: {

        deleteFormInit: function (event) {
            if (event) event.preventDefault();

            var id = $(event.target).closest('.delete-link').attr("data-id");
            $("#id-to-delete").val(id);

            $("#delete-message").html("");

            $(window).scrollTo($("#deleteForm"), 200);

            $('#deleteFieldset').addClass("highlight");
            setTimeout(function () {
                $("#deleteFieldset").removeClass("highlight");
            }, 2000);
        },

        deleteFormSubmit: function (event) {
            if (event) event.preventDefault();

            var $form = $(event.target).closest("form"),
                id = $form.find("input[name='id']").val(),
                apiUrl = $form.attr("action");

            var posting = $.ajax({
                type: "DELETE",
                url: apiUrl + '/' + id
            });

            posting.fail(function (data) {
                $("#delete-message").html("Error : " + data.responseJSON.error + "- code : " + data.responseJSON.errorCode);
            });

            posting.done(function (data) {
                $("#delete-message").html("Object " + data.objectID + " deleted!");
            });
        },

        postFormSubmit: function (event) {
            if (event) event.preventDefault();

            var $form = $(event.target).closest("form"),
                name = $form.find("input[name='name']").val(),
                image = $form.find("input[name='image']").val(),
                link = $form.find("input[name='link']").val(),
                category = $form.find("input[name='category']").val(),
                rank = $form.find("input[name='rank']").val(),
                apiUrl = $form.attr("action");

            var posting = $.post(apiUrl, {
                name: name,
                image: image,
                link: link,
                category: category,
                rank: rank
            });


            posting.fail(function (data) {
                $("#post-message").html("Error : " + data.responseJSON.error + "- code : " + data.responseJSON.errorCode);
            });

            posting.done(function (data) {
                $("#post-message").html("Object " + data.objectID + " added!");
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
