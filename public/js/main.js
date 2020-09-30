window.onload = function () {
   $('#datablegeneral').DataTable({
      "responsive": true,
      "autoWidth": false,
   });
   $('#nav-tab_category_permission').tab('show');

   $('.tooltip').tooltip();
};
