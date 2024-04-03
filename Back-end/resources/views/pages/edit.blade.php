@extends('layouts.app')
@section('content')
    <h1>Modifica Profilo</h1>

    {{-- @auth --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-inline">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="sponsorship-form" method="POST" action="{{ route('user.sponsorship') }}">
        @csrf
        <!-- Campo nascosto per l'ID dell'insegnante -->
        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
        <!-- Bottone per inviare il modulo -->
        <button type="submit">Sponsorizzazione</button>
    </form>
    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" id="Form_update">

        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <div class="container">
            <div class="row gutters">
                <div class="col-xl-4 col-lg-3 col-md-12 col-sm-12 col-12 mb-3">
                    <div class="card p-0 h-20">
                        <div class="card-header bg-transparent border-primary text-primary" style="font-weight: bold">FOTO
                            PROFILO
                        </div>
                        <div class="card-body border-dark p-3 m-0 d-flex flex-row justify-content-center">
                            <div class="account-settings">
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="">
                                </div>
                                <div style="text-align: center">
                                    <label for="image_url" class="btn btn-success">MODIFICA FOTO</label>
                                    <input type="file" id="image_url" name="image_url" style="display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div style="position: relative;">
                            <a href="{{ route('teacher.index', Auth::user()->id) }}" target="_blank" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></a>
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 20px; background-color: black; z-index: 2;"></div>
                            <embed src="{{ asset('storage/' . $teacher->cv_url) }}" type="application/pdf" width="100%" height="400px" style="position: relative; z-index: 0; display: none;">
                          </div>

                    </div>
                </div>
                <div class="col-xl-8 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-header bg-transparent border-primary text-primary" style="font-weight: bold">
                            DETTAGLI PROFILO
                        </div>
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="phone_number">TELEFONO
                                                <span style="color: red; font-size: 1.5em;">*</span>
                                            </label>
                                            <input type="number" class="form-control" id="phone_number" name="phone_number"
                                                value="{{ $teacher->phone_number }}"">
                                            <span id="PhoneNo"class="text-danger d-none"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="city">CITTÀ <span
                                                    style="color: red;  font-size: 1.5em;">*</span></label>
                                            <select id="city" class="form-control" name="city">
                                                <option value="{{ $teacher->city }}" selected>{{ $teacher->city }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="tax_id">P.IVA <span
                                                style="color: red;  font-size: 1.5em;">*</span></label>
                                        <input type="text" class="form-control" id="tax_id" name="tax_id"
                                            value="{{ $teacher->tax_id }}">
                                        <span id="taxNo"class="text-danger d-none"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="cv_url">CARICA CV <span style="color: red;  font-size: 1.5em;">
                                                *</span></label>
                                        <input type="file" class="form-control" id="cv_url" name="cv_url"
                                            accept=".pdf">
                                    </div>

                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <div class="d-flex flex-column">
                                            <label for="biography">BIOGRAFIA <span
                                                    style="color: red;  font-size: 1.5em;">*</span></label>
                                            <textarea name="biography" class="form-control" id="biography">{{ $teacher->biography }}</textarea>
                                            <span id="bioNo"class="text-danger d-none"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        <label class="mb-2">SELEZIONA MATERIE <span
                                                style="color: red; font-size: 1.5em;"> *</span></label>
                                        <br>

                                        @foreach ($subjects as $subject)
                                            <input type="checkbox" class="form-check-input"
                                                id="subject{{ $subject->id }}" name="subjects[]"
                                                value="{{ $subject->id }}"
                                                {{ $teacher->subjects->contains($subject->id) ? 'checked' : '' }}>
                                            <label for="subject{{ $subject->id }}">{{ $subject->name }}</label><br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="motto">MOTTO</label>
                                        <textarea class="form-control" id="motto" name="motto">{{ $teacher->motto }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="d-flex justify-content-between mt-4 text-right">
                                        <div style="color: red; font-size: 1em; text-align: left; font-weight:bold; ">* I
                                            seguenti campi sono obbligatori</div>
                                        <input type="submit" class="btn btn-primary" value="AGGIORNA PROFILO">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- @endauth --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            getCities();

            function populateCitySelect(cities) {
                const select = document.getElementById("city");
                cities.forEach(city => {
                    const option = document.createElement("option");
                    option.value = city.nome;
                    option.textContent = city.nome;
                    select.appendChild(option);
                });
            }

            function getCities() {
                fetch('https://axqvoqvbfjpaamphztgd.functions.supabase.co/comuni')
                    .then(response => response.json())
                    .then(data => {
                        // Controlla se ci sono risultati
                        if (Array.isArray(data) && data.length > 0) {
                            populateCitySelect(data);
                        } else {
                            console.log("Nessuna città trovata.");
                        }
                    })
                    .catch(error => {
                        console.error("Si è verificato un errore:", error);
                    });
            }
        });
        document.getElementById("Form_update").addEventListener("submit", function(event) {
            event.preventDefault();

            let validation = 0;
            var teachers = <?php echo json_encode($teachers); ?>;
            var teacherSingle = <?php echo json_encode($teacher); ?>;
            let taxID = document.getElementById('tax_id').value;
      
            let phone = document.getElementById('phone_number');

            validation += checkTaxID(taxID, teachers, teacherSingle); // Non è necessario passare teacher qui
           
            validation += checkPhone(phone_number, teacherSingle);

            if (validation == 2) {
                this.submit();
            }


            function checkPhone(phone, teacherSingle) {
                let isUnique = true;


                for (let i = 0; i < teachers.length; i++) {
                    if (phone.value == teachers[i].phone_number && teachers[i].id == teacherSingle.id) {
                        break;
                    }
                    if (phone.value === teachers[i].phone_number) {
                        // La partita IVA è un duplicato
                        isUnique = false;
                        break; // Esci dal ciclo perché hai trovato un duplicato
                    }
                }

                if (!isUnique) {

                    document.getElementById('PhoneNo').classList.remove('d-none');
                    document.getElementById('PhoneNo').innerHTML = 'Il numero di telefono è già inserito!';
                } else {

                    document.getElementById('PhoneNo').classList.add('d-none');

                }
                return isUnique;
            }

            function checkTaxID(taxID, teachers, teacher) {
                let isUnique = true;

                // Cicla attraverso gli insegnanti
                for (let i = 0; i < teachers.length; i++) {
                    // Controlla se la partita IVA è un duplicato
                    if (taxID == teacher.tax_id) {
                        break;
                    }
                    if (taxID === teachers[i].tax_id) {
                        // La partita IVA è un duplicato
                        isUnique = false;
                        break; // Esci dal ciclo perché hai trovato un duplicato
                    }
                }

                if (!isUnique) {
                    // Mostra un messaggio di errore se la partita IVA è un duplicato
                    document.getElementById('taxNo').classList.remove('d-none');
                    document.getElementById('taxNo').innerHTML = 'La partita IVA inserita è già stata utilizzata!';
                } else {
                    // Nascondi il messaggio di errore se la partita IVA non è un duplicato
                    document.getElementById('taxNo').classList.add('d-none');

                }

                return isUnique;
            }
        });
    </script>
@endsection
