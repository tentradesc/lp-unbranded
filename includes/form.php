<form id="formsubmit" method="POST" class="formLead form-horizontal registration-form">
    <div class="row">

        <div style="width: 50% !important;" class="input-group col-lg-12">
            <input name="first_name" type="text" class="form-control" placeholder="Nome" required>
        </div>
        <div style="width: 50% !important;" class="input-group col-lg-12">
            <input name="last_name" type="text" class="form-control" placeholder="Cognome" required>
        </div>


        <div class="input-group col-lg-12">
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Telefono" required>

        </div>
    </div>
    <div class="row">
        <div class="input-group col-lg-12">
            <input name="email" type="email" class="form-control" placeholder="E-mail">
            <input type="hidden" id="utm_source" name="utm_source"
                value="<?php echo htmlspecialchars($utm_source) ?>" />
            <input type="hidden" id="utm_campaign" name="utm_campaign"
                value="<?php echo htmlspecialchars($utm_campaign) ?>" />
            <input type="hidden" id="utm_medium" name="utm_medium"
                value="<?php echo htmlspecialchars($utm_medium) ?>" />
            <input type="hidden" id="utm_content" name="utm_content"
                value="<?php echo htmlspecialchars($utm_content) ?>" />
            <input type="hidden" id="utm_term" name="utm_term" value="<?php echo htmlspecialchars($utm_term) ?>" />
            <input type="hidden" id="lead" name="lead" class="form-control1" value="false" />
            <input type="hidden" id="lang" name="lang" class="form-control1" value="it" />
            <input type="hidden" id="country" name="country" class="form-control1" value="" />
            <input type="hidden" id="city" name="city" class="form-control1" value="" />
        </div>
    </div>
    <span class="form_checkbox">
        <input type="checkbox" id="vehicle1" name="vehicle1" value="">
        <label for="vehicle1">Confermi di avere almeno 18 anni e di aver letto la
            nostra
            <a href="https://cabinet.10tradefx.com/uploads/public/company-documents/2025/02/10/c7db949f13949e59025ad01c61076749.pdf?utm_source=investing&utm_medium=lp&utm_campaign=investing-lp"
                target="_blank" class="underline"> Politica di esclusione di
                responsabilità
            </a>
        </label>
    </span>
    <div id="loading-spinner"
        style="display: none;text-align: center;    margin-top: -56px !important;    margin-bottom: 60px;">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <button type="submit" id="submit-button" class="submit-button" disabled>Registrati e inizia a fare trading</button>
</form>