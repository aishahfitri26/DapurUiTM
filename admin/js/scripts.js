function confirmDelete(id) {
   if (confirm("Are you sure you want to delete this menu item?")) {
       var form = document.createElement("form");
       form.setAttribute("method", "post");
       form.setAttribute("action", "delete_menu.php");

       var hiddenField = document.createElement("input");
       hiddenField.setAttribute("type", "hidden");
       hiddenField.setAttribute("name", "menu_id");
       hiddenField.setAttribute("value", id);

       form.appendChild(hiddenField);
       document.body.appendChild(form);
       form.submit();
   }
}