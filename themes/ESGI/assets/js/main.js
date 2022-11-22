$(document).ready(function () {
  ajaxifyLinks();
});

function ajaxifyLinks() {
  $('a.page-numbers').click(function (e) {
    e.preventDefault(); // récupérer le n° de page

    var current = Number($('.current').html());
    var page;

    if ($(this).hasClass('next')) {
      page = current + 1;
    } else if ($(this).hasClass('prev')) {
      page = current - 1;
    } else {
      page = $(this).html();
    } // lancer la fonction loadPosts(page)


    loadPosts(page); // mettre à jour l'url de la fenêtre de navigation

    window.history.pushState({}, '', $(this).attr('href'));
  });
}

function loadPosts(page) {
  $.ajax({
    url: ajaxURL,
    type: 'POST',
    data: {
      action: 'load_posts',
      page: page
    },
    beforeSend: function beforeSend() {
      /* code exécuté juste avant l'envoi de la requête */
    },
    success: function success(reponse, statut) {
      //console.log(reponse)
      $('#ajax-response').html(reponse);
      ajaxifyLinks();
    },
    error: function error(reponse, statut, erreur) {
      /* code exécuté en cas d’erreur */
    },
    complete: function complete(resultat, statut) {
      /* code exécuté une fois l’appel AJAX effectué */
    }
  }); // créer un objet ajax 
  // url = ajaxURL (valeur transmise par PHP via wp_localize_script)
  // page = page en argument
  // prise en charge de la réponse
  // Affichage dans une bloc
}
