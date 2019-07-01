@if ($errors->any())
        <div class="alert alert-danger">
        	<p>Error al ingresar datos</p>
        	<br>
        	<ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif