<html>
<head>
	<title>Employees</title>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script>

</head>
<body>

  <div id="container"></div>
  <script>
    $(function() {
      $('#container').jstree({
        'core' : {
          'data' : {
            "url" : "{{ url('/showtree') }}",
            "dataType" : "json" // needed only if you do not supply JSON headers
          }
        }
      });
    });
  </script>

</body>
</html>