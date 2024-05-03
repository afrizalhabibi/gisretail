<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GIS Retail</title>
  <link rel="shortcut icon" type="image/png" href="<?php base_url()?>/assets/images/logos/favicon.png"/>
  <link rel="stylesheet" href="<?php base_url()?>/assets/css/styles.min.css"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css"
     crossorigin=""/>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="<?php base_url()?>/assets/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<style>
     /* Change the font of Leaflet popup */
     .leaflet-popup-content-wrapper, .leaflet-popup-tip {
          font-family: "Plus Jakarta Sans", sans-serif; /* Change the font family as needed */
          /* font-size: 13px; Change the font size as needed */
          color: #5a6a85;
     }
</style>
</head>