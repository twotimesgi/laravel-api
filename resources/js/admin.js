

 const { default: Axios } = require('axios');
 const { defaultsDeep } = require('lodash');

 require('./bootstrap');



 const btnSlugger = document.querySelector('#btn-slugger');
 if (btnSlugger) {
     btnSlugger.addEventListener('click', function () {
         const eleSlug = document.querySelector('#slug');
         const title = document.querySelector('#title').value;


         Axios.post('/admin/slugger', {
             originalString: title,
         })
             .then(function(response) {
                 eleSlug.value = response.data.slug;
             })
     });
 }

 const confirmationOverlay = document.getElementById('confirmation-overlay');
 if (confirmationOverlay) {
     const confirmationForm = confirmationOverlay.querySelector('form');

     document.querySelectorAll('.btn-delete').forEach(button => {
         button.addEventListener('click', function() {
             confirmationOverlay.classList.remove('d-none');
             let id = this.closest('tr').dataset.id;
             let newAction = confirmationForm.dataset.base;
             newAction = newAction.replace('*****', id);
             confirmationForm.action = newAction;
         });
     });


     document.getElementById('btn-no').addEventListener('click', function() {
         confirmationForm.action = '';
         confirmationOverlay.classList.add('d-none');
     })
 }
