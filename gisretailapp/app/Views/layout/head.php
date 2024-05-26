<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIG Toko Swalayan</title>
  <link rel="shortcut icon" type="image/png" href="<?php base_url()?>/assets/images/logos/favicon.png"/>
  <link rel="stylesheet" href="<?php base_url()?>/assets/css/styles.min.css"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.min.css"
     crossorigin=""/>
     <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<!-- Leaflet MarkerCluster -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-extra-markers/dist/css/leaflet.extra-markers.min.css" />
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
<!-- end MarkerCluster -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js"></script>
<script src="https://unpkg.com/leaflet-extra-markers/dist/js/leaflet.extra-markers.min.js"></script>
<script src="https://kit.fontawesome.com/f6e7390eb8.js" crossorigin="anonymous"></script>



<style>
     /* Change the font of Leaflet popup */
     .leaflet-popup-content-wrapper, .leaflet-popup-tip {
          font-family: "Plus Jakarta Sans", sans-serif; /* Change the font family as needed */
          /* font-size: 13px; Change the font size as needed */
          color: #5a6a85;
     }

     .extra-marker .svg-inline--fa, .extra-marker i {
     margin-top: 10px;
     }

     .form-switch {
     display: inline-block;
     cursor: pointer;
     -webkit-tap-highlight-color: transparent;
     }
     .form-switch i {
     position: relative;
     display: inline-block;
     margin-right: .5rem;
     width: 46px;
     height: 26px;
     background-color: #F6F9FC;
     border-radius: 23px;
     vertical-align: text-bottom;
     transition: all 0.3s linear;
     }
     .form-switch i::before {
     content: "";
     position: absolute;
     left: 0;
     width: 42px;
     height: 22px;
     background-color: #BDC1C8;
     border-radius: 11px;
     transform: translate3d(2px, 2px, 0) scale3d(1, 1, 1);
     transition: all 0.25s linear;
     }
     .form-switch i::after {
     content: "";
     position: absolute;
     left: 0;
     width: 22px;
     height: 22px;
     background-color: #fff;
     border-radius: 11px;
     box-shadow: 0 2px 2px rgba(0, 0, 0, 0.24);
     transform: translate3d(2px, 2px, 0);
     transition: all 0.2s ease-in-out;
     }
     .form-switch:active i::after {
     width: 28px;
     transform: translate3d(2px, 2px, 0);
     }
     .form-switch:active input:checked + i::after { transform: translate3d(16px, 2px, 0); }
     .form-switch input { display: none; }
     .form-switch input:checked + i { background-color: #003CBE; }
     .form-switch input:checked + i::before { transform: translate3d(18px, 2px, 0) scale3d(0, 0, 0); }
     .form-switch input:checked + i::after { transform: translate3d(22px, 2px, 0); }
</style>
</head>