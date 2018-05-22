<?php
// Template Name: fontawesome


// Note1. Need to add this line 
// <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
// to header.php 
the_post();
get_header(); 
?>

<div class="page">

  <p class="product">abc</p>

  <!-- Note2. ::after ::before don't work with <input> <image> -->
  <input class="product" /> 


  
</div>

<?php get_footer(); ?>