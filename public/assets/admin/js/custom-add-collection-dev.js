$(document).ready(function(){

  

    // var $collectionHolder;
    //
    //
    //
    // // setup an "add a tag" link
    // var $addTagButton = $('<button type="button" class="add_tag_link btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-pencil-alt"></i></span><span class="text">Añadir Relación</span></button>');
    // var $newLinkLi = $('<li class="col-12"></li>').append($addTagButton);
    //
    // jQuery(document).ready(function() {
    //
    //
    //
    //     // Get the ul that holds the collection of tags
    //     $collectionHolder = $('ul.parents');
    //
    //     // add the "add a tag" anchor and li to the tags ul
    //     $collectionHolder.append($newLinkLi);
    //
    //     // count the current form inputs we have (e.g. 2), use that as the new
    //     // index when inserting a new item (e.g. 2)
    //     $collectionHolder.data('index', $collectionHolder.find(':input').length);
    //
    //     $addTagButton.on('click', function(e) {
    //         // add a new tag form (see next code block)
    //         addTagForm($collectionHolder, $newLinkLi);
    //     });
    // });
    //
    //
    //
    // function addTagForm($collectionHolder, $newLinkLi) {
    //     // Get the data-prototype explained earlier
    //     var prototype = $collectionHolder.data('prototype');
    //
    //     // get the new index
    //     var index = $collectionHolder.data('index');
    //
    //     var newForm = "<div class='col-lg-12 pb-4' id='item-__name__'><hr><div class='delete_item'><i title='Elimnar esta opción' class='fas fa-trash  mr-3 text-danger' data-iditem='__name__'></i></div>"+prototype+"</div>";
    //     // You need this only if you didn't set 'label' => false in your tags field in TaskType
    //     // Replace '__name__label__' in the prototype's HTML to
    //     // instead be a number based on how many items we have
    //     // newForm = newForm.replace(/__name__label__/g, index);
    //
    //     // Replace '__name__' in the prototype's HTML to
    //     // instead be a number based on how many items we have
    //     newForm = newForm.replace(/__name__/g, index);
    //
    //     // increase the index with one for the next item
    //     $collectionHolder.data('index', index + 1);
    //
    //     // Display the form in the page in an li, before the "Add a tag" link li
    //     var $newFormLi = $('<li></li>').append(newForm);
    //     $newLinkLi.after($newFormLi);
    // }

});
