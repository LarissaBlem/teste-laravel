@extends('layouts.master')
<!-- CSS -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<style>
    .hide {
        display: none;
    }
</style>
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Cadastro de Revisao</h2>
                    </div>
                    <div class="pull-right">
                       
                    </div>
                </div>
            </div>

            <form action="{{ route('revisao.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Proprietário:</strong>
                            <input type="text" id='pessoa_search' class="form-control" placeholder="Name">
                            <input type="hidden" id='pessoaid' name="pessoa_id">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 hide" id="select-carro">
                        <div class="form-group">
                            <strong>Carro:</strong>
                            <select name="carro_id" class="form-control" id="select-carros">
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Data da Revisão:</strong>
                            <input type="date" name="data_revisao" class="form-control"/>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>OBS:</strong>
                            <textarea name='obs' class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center" class="card-body">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-primary" href="{{ route('pessoa.index') }}"> voltar</a>
                    </div>
                </div>
            </form>

                <!-- Script -->
                <script type="text/javascript">
                    // CSRF Token
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $(document).ready(function() {

                        $("#pessoa_search").autocomplete({
                            source: function(request, response) {
                                // Fetch data
                                $.ajax({
                                    url: "{{ route('pessoa.getPessoas') }}",
                                    type: 'post',
                                    dataType: "json",
                                    data: {
                                        _token: CSRF_TOKEN,
                                        search: request.term
                                    },
                                    success: function(data) {
                                        response(data);
                                    }
                                });
                            },
                            select: function(event, ui) {
                                // Set selection
                                $('#pessoa_search').val(ui.item.label); // display the selected text
                                $('#pessoaid').val(ui.item.value); // save selected id to input
                                showCars(ui.item.value);
                                return false;
                            }
                        });

                    });

                    function showCars(proprietario_id) {
                        $('.toremove').remove();
                        var $select = $('#select-carros');
                        $.ajax({
                            url: "{{ route('carro.getCarros') }}",
                            type: 'post',
                            dataType: "json",
                            data: {
                                _token: CSRF_TOKEN,
                                proprietario_id: proprietario_id
                            },
                            success: function(data) {
                                
                                data.forEach(function(v,i,a) {
                                    $select.append('<option class="toremove" value="'+v.value+'">'+v.label+'</option>');
                                });
                                $('#select-carro').show();
                            }
                        });
                    };
                </script>
        </div>
    </div>
@endsection
