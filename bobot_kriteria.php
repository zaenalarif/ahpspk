<?php
	include('config.php');
	include('fungsi.php');

	include('header.php');
?>
<style>
        @import 'https://fonts.googleapis.com/css?family=Open+Sans';
        html {
        box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
        box-sizing: inherit;
        }

        body {
        font-family: "Open Sans", sans-serif;
        }

        .stv-radio-buttons-wrapper {
        clear: both;
        display: inline-block;
        }

        .stv-radio-button {
        position: absolute;
        /* left: -9999em; */
        /* top: -9999em; */
        }
        .stv-radio-button + label {
        float: left;
        padding: 0.5em 1em;
        cursor: pointer;
        border: 1px solid #28608f;
        margin-right: -1px;
        color: #fff;
        background-color: hsl(246, 69%, 19%);
        }
        .stv-radio-button + label:first-of-type {
        border-radius: 0.7em 0 0 0.7em;
        }
        .stv-radio-button + label:last-of-type {
        border-radius: 0 0.7em 0.7em 0;
        }
        .stv-radio-button:checked + label {
        background-color: hsl(350, 71%, 51%);
        }
  </style>
<?php
	include('subheader.php');
?>
	<h2 >Perbandingan Kriteria</h2>
	<?php showTabelPerbandingan('kriteria','kriteria'); ?>

<?php include('footer.php'); ?>