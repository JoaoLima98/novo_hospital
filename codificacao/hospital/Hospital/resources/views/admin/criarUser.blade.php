    @extends('Template.layout')

    @section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">Cadastro de Usuário</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('store.usuario') }}" id="userForm">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <!-- Telefone -->
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone">
                            </div>

                            <!-- Perfil -->
                            <div class="mb-3">
                                <label for="perfil" class="form-label">Perfil</label>
                                <select class="form-select" id="perfil" name="perfil" required>
                                    <option value="">Selecione</option>
                                    <option value="admin">Admin</option>
                                    <option value="enfermeiro">Enfermeiro</option>
                                    <option value="medico">Médico</option>
                                    <option value="recepcionista">Recepcionista</option>
                                    <option value="farmaceutico">Farmaceutico</option>
                                </select>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <!-- Campos extras do Médico -->
                            <div id="medico-fields" style="display: none;">
                                <hr>
                                <h5>Dados do Médico</h5>

                                <div class="mb-3">
                                    <label for="crm" class="form-label">CRM</label>
                                    <input type="text" class="form-control" id="crm" name="crm">
                                </div>

                                <div class="mb-3">
                                    <label for="especialidade" class="form-label">Especialidade</label>
                                    <input type="text" class="form-control" id="especialidade" name="especialidade">
                                </div>
                            </div>

                            <div id="enfermeiro-fields" style="display: none;">
                                <hr>
                                <h5>Dados do enfermeiro</h5>

                                <div class="mb-3">
                                    <label for="coren" class="form-label">COREN</label>
                                    <input type="text" class="form-control" id="coren" name="coren">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts na ordem CORRETA -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            try {
                $('#telefone').inputmask('(99) 99999-9999');
                $('#medico_telefone').inputmask('(99) 99999-9999');
                $('#crm').inputmask('999999');
                $('#coren').inputmask('999999');
                console.log('Máscaras aplicadas com sucesso');
            } catch (error) {
                console.error('Erro ao aplicar máscaras:', error);
            }

            $('#perfil').change(function() {
                const valor = $(this).val();
                if (valor === 'medico') {
                    $('#medico-fields').show();
                    $('#enfermeiro-fields').hide();
                } else if (valor === 'enfermeiro') {
                    $('#enfermeiro-fields').show();
                    $('#medico-fields').hide();
                } else {
                    $('#medico-fields').hide();
                    $('#enfermeiro-fields').hide();
                }
            });

            // SweetAlert antes de enviar
            $('#userForm').on('submit', function(e) {
                e.preventDefault();
                
                console.log('Formulário submetido - mostrando SweetAlert');
                
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Quer mesmo cadastrar este usuário?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, cadastrar!',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Usuário confirmou - enviando formulário');

                        $('#userForm').off('submit').submit();
                    } else {
                        console.log('Usuário cancelou');
                    }
                });
            });
        });
    </script>
    @endsection



