@extends('layouts.master')
@section('content')

 <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Cadastro de Pessoa</h2>
                </div>
            </div>
        </div>

        <form class="mb-3 needs-validation" action="{{ route('pessoa.store') }}" method="POST">
            @csrf
            <div>
                <div class="col-xs-12 col-sm-12 col-md-12 has-validation">
                    <div class="">
                        <strong>Nome:</strong>
                        <input type="text" name="nome" class="form-control" placeholder="Nome Completo" aria-label="default input example" required>
                    </div>
                </div>

                <div  class="mb-3">
                    <div class="">
                        <strong>Gênero:</strong>
                        <select name="genero" class="form-select" aria-label="Default select example" required>
                            <option value="F">Feminino</option>
                            <option value="M">Masculino</option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Data de Nascimento:</strong>
                        <input type="date" name="dt_nasc" required />
                    </div>
                </div>
                <br/>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center" class="card-body">
                        <button  class="btn btn-primary" type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-primary" href="{{ route('pessoa.index') }}"> voltar</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
@endsection