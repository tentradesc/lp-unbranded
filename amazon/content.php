<style>
    .btn-warning {
        color: #212529;
        background-color: transparent;
        border-color: transparent;
    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-height: 1px;
        padding: 0rem;
    }

    .card {

        border: 0px solid rgba(0, 0, 0, .125);

    }

    #loading-spinner {
        text-align: center;
    }

    #loading-spinner2 {
        text-align: center;
    }

    .spinner {
        margin: 20px auto;
        width: 70px;
        text-align: center;
    }

    .spinner>div {
        width: 18px;
        height: 18px;
        background-color: #313131;
        border-radius: 100%;
        display: inline-block;
        -webkit-animation: bounce 1.4s infinite ease-in-out;
        animation: bounce 1.4s infinite ease-in-out;
    }

    .spinner .bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .spinner .bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }

    @-webkit-keyframes bounce {

        0%,
        80%,
        100% {
            -webkit-transform: scale(0);
        }

        40% {
            -webkit-transform: scale(1);
        }
    }

    @keyframes bounce {

        0%,
        80%,
        100% {
            transform: scale(0);
        }

        40% {
            transform: scale(1);
        }
    }



    /* CSS for the spinner */
    .spinner2 {
        border: 4px solid rgba(0, 0, 0, 0.2);
        /* Clear border */
        border-top: 4px solid #007bff;
        /* Change the color to your preference */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        background-color: rgba(255, 255, 255, 0.6);
        /* Clear background */
        z-index: 9999;
        /* Ensure it's on top of other content */
    }

    /* Keyframes for the spinner animation */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* CSS to hide the spinner when the page is loaded */
    .loaded .spinner2 {
        display: none;
    }
</style>
<script>
    $(document).ready(function () {
        $.ajax({
            url: 'https://tentrade.com/restfulservice/v1/get-location.php/',
            method: 'GET',
            success: function (response) {
                if (response.status) {
                    const location = response.data;

                    // Example: auto-fill a country input field
                    $('#country').val(location.countryCode || 'IT');
                    $('#city').val(location.city || 'IT');
                } else {
                    console.warn('Failed to get location:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    });
</script>
<script>
    jQuery(function ($) {
        $('#formsubmit').submit(function (event) {
            // Prevent the default form submission
            event.preventDefault();

            // Store original phone value and prepend dial code
            var originalPhone = $('#phone').val().trim();
            var dialCode = $('.selected-dial-code').text().trim();
            $('#phone').val(dialCode + originalPhone);

            $('#success-message').hide();

            // Show spinner loader
            $('#loading-spinner').show();

            // Serialize form data
            var formData = $(this).serialize();

            // alert(formData);

            //  return;

            // AJAX post request
            $.post({
                url: 'https://tentrade.com/restfulservice/v1/create-client.php',
                data: formData,
                success: function (response) {
                    // Hide spinner loader
                    $('#loading-spinner').hide();

                    var status = response.status;

                    if (status == 1) {

                        $('#error-message').hide();
                        $('#success-message').text("Registration successful").show();

                        dataLayer.push({
                            'event': 'generate_lead',
                            'userData': {
                                'sha256_email_address': response.data.sha256_email_address,
                                'sha256_phone_number': response.data.sha256_phone_number,
                            }
                        });

                    } else {

                        $('#success-message').hide();

                        /*
                        if(response.data.errors && Array.isArray(response.data.errors)) {
   
                           var errorMessages = response.data.errors.map(function (error) {
                              return error.message || 'Unknown error';
                           });
   
                           $('#error-message').html(errorMessages.join('<br>')).show();
   
                        } else {
   
                           $('#error-message').text('Unknown Error').show();
   
                        }
                        */

                    }

                },
                error: function (xhr, status, error) {
                    // Hide spinner loader
                    $('#loading-spinner').hide();

                    var arr = xhr.responseJSON.data.errors;
                    var message = '';

                    var errorMessages = $.map(arr, function (n) {
                        return n.message;
                    });

                    var finalMessage = errorMessages.length === 1
                        ? errorMessages[0]
                        : errorMessages.join(', ');


                    $('#error-message').text(finalMessage).show();


                }

            });
        });
    });
</script>



<style>
    #loader {
        display: none;
        border: 4px solid #f3f3f3;
        border-radius: 50%;
        border-top: 4px solid #3498db;
        width: 20px;
        height: 20px;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
        position: absolute;
        margin-top: -35px;
        margin-left: 0px;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    #error-message,
    #success-message {
        display: none;
        color: red;
        margin-top: 10px;
        font-size: 14px;
    }

    #success-message {
        color: green;
    }


    #error-message2,
    #success-message2 {
        display: none;
        color: red;
        margin-top: 10px;
        font-size: 14px;
    }

    #success-message2 {
        color: green;
    }

    #country {
        display: none;
    }
</style>


<section class="header-section">
    <div class="container">
        <div class="page-content">
            <div class="header d-none">
                <div class="">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">

                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-section">
                <div class=" banner_section_content">
                    <div class="row">
                        <div class="col-lg-6 d-flex justify-content-center align-items-center order-lg-1 order-2">

                            <img src="assets/amazon-image.png" width="100%">
                        </div>
                        <div class="col-lg-6 order-lg-2 order-1">
                            <h1 class="head-title text-white"> Offerta Amazon Esclusiva per l’Italia 100% Bonus <a
                                    class="cursor_point" onclick="openPopup()"> (?) </a> + 20% Cashback <a
                                    class="cursor_point" onclick="openPopupp()">(?)</a> </h1>
                            <p class="heroSbHead text-white">Registrati in meno di 3 minuti e inizia a fare trading con
                                una
                                piattaforma regolamentata.</p>
                            <!-- Form Section -->
                            <section>
                                <div class="form-container">
                                    <?php include __DIR__ . '/../includes/form.php'; ?>
                                </div>
                            </section>
                            <!-- Form Section End -->

                        </div>

                    </div>

                </div>
            </div>

            <p class="text-center motion_money mb-5">
                Acquista 100 azioni Amazon oggi e ottieni un possibile profitto di <b>4.300$</b> entro la fine dell'anno
            </p>

        </div>
    </div>
</section>

<!-- header-section End-->
<!-- Why Choose Section -->
<section class="whyChoose-section_main">
    <div class="container-fluid">
        <div class="whyChoose-section text-center mb-5 text-white">
            <h2>
                Perché investire in azioni Amazon?

            </h2>
            <!-- <p class="text-white">
                  Acquista 100 azioni Amazon oggi e ottieni un possibile profitto di 4.300$ entro la fine dell'anno
               </p> -->
        </div>
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="step-box d-flex flex-column text-white text-start mb-4">
                        <div class="card-text mt-3 text-white">
                            <h4 class="text-gold ">Crescita e rendimento nel tempo </h4>
                            <p class="text-white">Le azioni sono uno degli strumenti più efficaci per costruire
                                ricchezza a
                                lungo termine, con il potenziale di generare profitti superiori rispetto ad altri
                                investimenti.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="step-box d-flex flex-column text-white text-start mb-4">
                        <div class="card-text mt-3 text-white">
                            <h4 class="text-gold ">Accesso ai leader di mercato</h4>
                            <p class="text-white">Investire in azioni ti permette di partecipare al successo delle più
                                grandi aziende globali, dai giganti tecnologici alle società in forte espansione.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="step-box d-flex flex-column text-white text-start">
                        <div class="card-text mt-3 text-white">
                            <h4 class="text-gold ">Diversificazione e gestione del rischio</h4>
                            <p class="text-white">Un portafoglio azionario ben bilanciato ti aiuta a ridurre i rischi e
                                a
                                cogliere le migliori opportunità nei diversi settori del mercato.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="step-box d-flex flex-column text-white text-start">
                        <div class="card-text mt-3 text-white">
                            <h4 class="text-gold ">Innovazione e futuro</h4>
                            <p class="text-white">Dall’intelligenza artificiale alla transizione energetica, il mercato
                                azionario è il motore delle innovazioni che plasmeranno il mondo di domani.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="cta-btn text-center">
                    <a href="#form_site" class="call-btn1 btn">
                        Inizia a fare trading
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="new_box">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="py-4">
                    Come investire in Amazon in modo semplice, veloce e sicuro
                </h2>
                <!-- <p class="mb-5">
                     Dalle nozioni di base alle strategie avanzate, eToro offre funzionalità uniche che portano il tuo portafoglio al livello successivo
                     </p> -->
                <div class="mb-4 d-lg-flex d-block align-items-baseline gap-3">
                    <div class="circle circle-01 text-white mr-3">
                        01
                    </div>
                    <div>
                        <h3 class="h5 font-weight-bold">
                            Crea il tuo account
                        </h3>
                        <p>
                            Registrati e crea un account.
                        </p>
                    </div>
                </div>
                <div class="mb-4 d-lg-flex d-block align-items-baseline gap-3">
                    <div class="circle circle-02 text-white mr-3">
                        02
                    </div>
                    <div>
                        <h3 class="h5 font-weight-bold">
                            Verifica
                        </h3>
                        <p>
                            Conferma la tua identità verificando con uno dei nostri partner di fiducia.
                        </p>
                    </div>
                </div>
                <div class="mb-4 d-lg-flex d-block align-items-baseline gap-3">
                    <div class="circle circle-03 text-white mr-3">
                        03
                    </div>
                    <div>
                        <h3 class="h5 font-weight-bold">
                            Deposito
                        </h3>
                        <p>
                            Deposita i tuoi fondi in modo sicuro tramite le nostre opzioni supportate.
                        </p>
                    </div>
                </div>
                <div class="mb-4 d-lg-flex d-block align-items-baseline gap-3">
                    <div class="circle circle-04 text-white mr-3">
                        04
                    </div>
                    <div>
                        <h3 class="h5 font-weight-bold">
                            Inizia a investire in Amazon
                        </h3>
                        <p>Tutto pronto! Inizia a investire in oltre 3.000 altri asset digitali.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                <img alt="Smartphone displaying investment app interface" class="img-fluid new_img w-100"
                    src="assets/Image-3.png" />
            </div>
            <div class="cta-btn1 text-center">
                <a href="#" class="call-btn1 btn">
                    Inizia a fare trading
                </a>
            </div>
        </div>
    </div>
</section>
<section class="whyChoose-section_main">
    <div class="container-fluid">
        <div class="whyChoose-section text-center mb-5 text-white">
            <h2>
                Investi con il miglior broker
            </h2>
            <p class="text-white">Unisciti ai milioni di commercianti che si affidano a noi per la nostra scalabilità
                flessibile, i pagamenti ultraveloci e il supporto.
            </p>
        </div>
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="step-box d-flex flex-column text-white text-start mb-4">
                        <div class="card-text mt-3 text-white">
                            <h4 class="text-gold ">Sicurezza dei Fondi <i class="fa-solid fa-shield-halved"></i></h4>
                            <p class="text-white">TenTrade si impegna a proteggere i tuoi interessi attraverso le nostre
                                solide misure di sicurezza finanziaria.

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="step-box d-flex flex-column text-white text-start mb-4">
                        <div class="card-text mt-3 text-white">
                            <h4 class="text-gold ">Supporto Personalizzato <i class="fa-solid fa-headset"></i></h4>
                            <p class="text-white">Il nostro team di supporto dedicato è a tua disposizione per fornirti
                                consulenza esperta e assistenza personalizzata ogni volta che ne avrai bisogno.

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="step-box d-flex flex-column text-white text-start">
                        <div class="card-text mt-3 text-white">
                            <h4 class="text-gold ">Pagamenti Rapidi <i class="fa-solid fa-money-bill-1-wave"></i></h4>
                            <p class="text-white">Si tratta di un processo di prelievo rapido e affidabile. Nessun
                                ritardo o
                                fastidio: solo pagamenti sicuri e senza problemi ogni volta che ne ha i bisogno!


                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="step-box d-flex flex-column text-white text-start">
                        <div class="card-text mt-3 text-white">
                            <h4 class="text-gold ">Strumenti di trading <i class="fa-solid fa-screwdriver-wrench"></i>
                            </h4>
                            <p class="text-white">Ottimizza la tua strategia, analizza i mercati in tempo reale e fai
                                trading in modo più intelligente con la nostra innovativa piattaforma MT5.


                            </p>
                        </div>
                    </div>
                </div>

                <div class="cta-btn text-center">
                    <a href="#form_site" class="call-btn1 btn">
                        Inizia a fare trading
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="new_box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="py-4 text-center">
                    Inizia a fare trading sulle azioni più di tendenza del momento <br> Scopri le opportunità di mercato
                    ora!
                </h2>
                <!-- <p class="mb-5">
                     Dalle nozioni di base alle strategie avanzate, eToro offre funzionalità uniche che portano il tuo portafoglio al livello successivo
                     </p> -->
                <div class="tab">
                    <button class="tablinks active" onclick="openCity(event, 'London')">Azioni popolari</button>
                    <button class="tablinks" onclick="openCity(event, 'Paris')">Tech</button>
                    <button class="tablinks" onclick="openCity(event, 'Tokyo')">Beni durevoli</button>
                    <button class="tablinks" onclick="openCity(event, 'kothada')">di consumo</button>
                </div>
                <div id="London" class="tabcontent">
                    <div class="in_flex">
                        <div class="tab_img">
                            <img class="w-100" src="assets/tab1.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/tab2.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/tab3.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/tab4.JPG">
                        </div>
                    </div>
                </div>
                <div id="Paris" class="tabcontent">
                    <div class="in_flex">
                        <div class="tab_img">
                            <img class="w-100" src="assets/2tab1.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/2tab2.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/2tab3.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/2tab4.JPG">
                        </div>
                    </div>
                </div>
                <div id="Tokyo" class="tabcontent">
                    <div class="in_flex">
                        <div class="tab_img">
                            <img class="w-100" src="assets/3tab1.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/3tab2.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/3tab3.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/3tab4.JPG">
                        </div>
                    </div>
                </div>
                <div id="kothada" class="tabcontent">
                    <div class="in_flex">
                        <div class="tab_img">
                            <img class="w-100" src="assets/4tab1.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/4tab2.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/4tab3.JPG">
                        </div>
                        <div class="tab_img">
                            <img class="w-100" src="assets/4tab4.JPG">
                        </div>
                    </div>
                </div>
            </div>
            <div class="cta-btn1 text-center">
                <a href="#" class="call-btn1 btn">
                    Inizia a fare trading
                </a>
            </div>
        </div>
    </div>
</section>
<footer class="pt-5 pb-5 bg-black" id="redirected_footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 footer-text">
                <p class="m-0">
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>. Tutti i diritti riservati.
                </p>
            </div>
            <!-- <div class="col-lg-6 footer-text">
                  <p class="legal"><a href="https://cabinet.10tradefx.com/uploads/public/company-documents/2025/02/10/c7db949f13949e59025ad01c61076749.pdf?utm_source=investing&utm_medium=lp&utm_campaign=investing-lp"
                     target="_blank">Termini e Condizioni </a> | <a
                     href="https://tentrade.com/en/company-policies-6/?utm_source=investing&utm_medium=langing-page-es&utm_campaign=trade-investing-lp-es"
                     target="_blank">Documenti legali</a> | <a
                     href="https://tentrade.com/en/contact-us-5/?utm_source=investing&utm_medium=lp&utm_campaign=investing-lp"
                     target="_blank">Contattaci</a></p>
                  </div> -->
            <p class="disclmber">Il trading di Forex e Contratti per Differenza (CFD) comporta un elevato livello di
                rischio e potrebbe non essere adatto a tutti gli investitori. Potresti perdere tutto o la maggior parte
                del tuo investimento iniziale. Il risultato può andare contro o per te. Prima di fare trading, considera
                attentamente i tuoi obiettivi, il livello di esperienza e la tolleranza al rischio. Se necessario,
                chiedi
                sempre una consulenza finanziaria indipendente. Le performance passate non sono indicative dei risultati
                futuri.</p>
        </div>
        <p></p>
    </div>
</footer>
<!-- Footer End -->
<script>
    const checkbox = document.getElementById("vehicle1");
    const submitButton = document.getElementById("submit-button");

    checkbox.addEventListener("change", function () {
        if (checkbox.checked) {
            submitButton.disabled = false; // Enable the button
        } else {
            submitButton.disabled = true; // Disable the button
        }
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.16/css/intlTelInput.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.16/js/intlTelInput.min.js"
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.16/js/utils.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
<script>

    jQuery("#carousel3").owlCarousel({
        autoplay: true,
        nav: true,
        loop: true,
        margin: 20,
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 10000,
        smartSpeed: 800,
        dots: false,
        responsive: {
            0: {
                items: 1
            },

            600: {
                items: 1
            },

            1024: {
                items: 3
            },

            1366: {
                items: 3
            }
        }
    });
    $('.moreless-button').click(function () {
        $('.moretext').slideToggle();

        if ($(this).text().trim() === "Read more") {
            $(this).text("Read less");
        } else {
            $(this).text("Read more");
        }
    });
</script>
<style type="text/css">
    form h3 {
        font-size: 20px;
        text-align: center;
    }

    .separate-dial-code {
        width: 100%
    }
</style>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>


<!-- Popup Modal -->
<div class="popup" id="popupModal">
    <div class="popup-content">
        <p>Bonus accreditato sul primo deposito. Si applicano termini e condizioni.</p>
        <button class="close-btn" onclick="closePopup()">Close</button>
    </div>
</div>

<script>
    // Function to open the popup
    function openPopup() {
        document.getElementById('popupModal').style.display = 'flex';
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById('popupModal').style.display = 'none';
    }
</script>



<!-- Popup Modal -->
<div class="popupp" id="popupModall">
    <div class="popup-contentt">
        <p>Cashback rimborsato alla fine del mese sulle perdite nette.</p>
        <button class="close-btnn" onclick="closePopupp()">Close</button>
    </div>
</div>

<script>
    // Function to open the popup
    function openPopupp() {
        document.getElementById('popupModall').style.display = 'flex';
    }

    // Function to close the popup
    function closePopupp() {
        document.getElementById('popupModall').style.display = 'none';
    }
</script>

<style>
    /* Popup Modal Styles */
    .popup {
        display: none;
        /* Initially hidden */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .popup-content {
        background: white;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
    }

    .close-btn {
        margin-top: 10px;
        padding: 5px 10px;
        background: #fd9600;
        color: white;
        border: none;
        cursor: pointer;
    }

    .popupp {
        display: none;
        /* Initially hidden */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .popup-contentt {
        background: white;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
    }

    .close-btnn {
        margin-top: 10px;
        padding: 5px 10px;
        background: #fd9600;
        color: white;
        border: none;
        cursor: pointer;
    }

    .cursor_point {
        cursor: pointer;
    }
</style>