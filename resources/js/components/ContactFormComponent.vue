<template>
  <form class="h5-valid">
    <!-- Don't show labels unless the input is empty and has no focus -->
    <!-- Don't show the placeholder unless input is empty and has focus -->
    <fieldset>
      <div class="form-element">
        <input type="text" class="box" name="fullname" required>
        <label>{{ $t('Full Name') }}</label>
      </div>
      <div class="form-element">
        <input type="text" class="box" name="subject">
        <label>{{ $t('Subject') }}</label>
      </div>
      <div class="form-element">
        <input type="tel" class="box" name="phone">
        <label>{{ $t('Phone Number') }}</label>
      </div>
      <div class="form-element">
        <input type="email" class="box" name="email" required>
        <label>{{ $t('Email Address') }}</label>
      </div>
    </fieldset>
    <div class="form-element">
      <textarea class="box" name="message" required></textarea>
    </div>
    <button type="submit" class="button large full-width brand-1">Submit Message</button>
  </form>
</template>

<script>
export default {
  
}
</script>

<style scoped>

</style>


<i18n>
{
  "en": {
    "Full Name": "Full Name",
    "Subject": "Subject",
    "Phone Number": "Phone Number",
    "Email Address": "Email Address",
    "Enter your message": "Enter your message",
    "Submit Message": "Submit Message"
  },
  "fr": {
    "Full Name": "Nom complet",
    "Subject": "Objet",
    "Phone Number": "Numéro de téléphone",
    "Email Address": "Adresse électronique",
    "Enter your message": "Entrez votre message",
    "Submit Message": "Soumettre un message"
  },
  "ar": {
    "Full Name": "Full Name",
    "Subject": "Subject",
    "Phone Number": "Phone Number",
    "Email Address": "Email Address",
    "Enter your message": "Enter your message",
    "Submit Message": "Submit Message"
  }
}
</i18n>
