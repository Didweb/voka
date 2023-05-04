

 $('.modaldel').on('click', function() {
     let name = $(this).data('name');
     let path = $(this).data('path');

     $('#name_category').html(name);
     $('#linkToDelete').attr('href', path);

 });

 $('.modaledi').on('click', function() {
     let id = $(this).data('id');
     let name = $(this).data('name');
     let createdAt = $(this).data('createdat');
     $('#edit_category_id').val(id);
     $('#edit_category_name').val(name);
     $('#edit_category_createdAt').val(createdAt);

 });

 $('.modaldel-word').on('click', function() {
     let name = $(this).data('name');
     let path = $(this).data('path');

     $('#name_category').html(name);
     $('#linkToDelete').attr('href', path);

 });


 $('.modalchangeimage-word').on('click', function() {
     let id = $(this).data('id');
     let old_name = $(this).data('name');

     $('#change_image_word_id').val(id);
     $('#change_image_word_oldName').val(old_name);

 });

 $('.modaledi-word').on('click', function() {
     let id = $(this).data('id');
     let word = $(this).data('word');
     let gender = $(this).data('gender');
     let level = $(this).data('level');
     let category = $(this).data('category');
     let createdAt = $(this).data('createdat');


     $('#edit_word_id').val(id);
     $('#edit_word_word').val(word);
     $('#edit_word_gender').val(gender);
     $('#edit_word_level').val(level);
     $('#edit_word_category').val(category.id);
     $('#edit_category_createdAt').val(createdAt);

 });


