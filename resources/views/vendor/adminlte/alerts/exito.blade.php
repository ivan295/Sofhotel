
@if (session('success'))
<center>
        <div id="mensaje" class="alert alert-success">
          {{session('success')}}
        </div>
    </center>
        @endif
<script type="text/javascript">
setTimeout(function() { 
    $('#mensaje').fadeOut('fast'); 
}, 5000);
 </script>

