<?php
/**
 *   Copyright (c) 2018, Falicrea
 *
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *   of this software and associated documentation files, to deal
 *   in the Software without restriction, including without limitation the rights
 *   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *   copies of the Software, and to permit persons to whom the Software is
 *   furnished to do so, subject to the following conditions:
 *
 *   The above copyright notice and this permission notice shall be included in all
 *   copies or substantial portions of the Software.
 */

 // « / » La documentation complète de l’API (c’est ce que nous affichons ci-dessus)
 // « /oembed/1.0 » Liste des fonctionnalités du service oembed (il s’agit d’une API dans l’API réservée au réseaux sociaux que nous ne détaillerons pas ici
 // « /wp/v2 » Liste des fonctionnalités du cœur de WordPress.
 // « /wp/v2/posts » Méthode permettant la création d’un post, ainsi que la recherche de posts
 // « /wp/v2/posts/(?P<id>[\\d]+) » Méthode permettant la consultation, modification ou suppression d’un post existant, à partir de son ID
 // « /wp/v2/users » Méthode permettant la création d’un utilisateur, ainsi que la recherche d’utilisateurs.
 // « /wp/v2/users/(?P<id>[\\d]+) » Méthode permettant la consultation, modification ou suppression d’un utilisateur existant, à partir de son ID
 // « /wp/v2/users/me » Méthode permettant la consultation, modification du compte utilisateur actuellement connecté sur l’API
 // « /wp/v2/settings » Méthode permettant de consulter et modifier la configuration de WordPress


 class jpMotorsAPI {
   public function __construct() {
     add_action('rest_api_init', function () {
       register_rest_route( 'api', '/author/(?P<id>\d+)', array(
       'methods' => 'GET',
       'callback' => [$this, 'get_post_by_author'],
       'args' => array(
  			'id' => array(
  				'validate_callback' => function ($param, $request, $key) {
  					return is_numeric( $param );
  				}
  			),
  		),
      'permission_callback' => function () {
  			return current_user_can( 'edit_others_posts' );
  		}
     ) );
     });
   }

   public function get_post_by_author($data) {
     $posts = get_posts( array(
    		'author' => $data['id'],
    	) );
    	if ( empty( $posts ) ) {
    		return null;
    	}
    	return $posts;
   }
 }

 new jpMotorsAPI();
