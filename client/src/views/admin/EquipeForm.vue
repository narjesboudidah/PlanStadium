<template>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-form-equipe/>
      </div>
      
    </div>
  </template>
  <script>
  import CardFormEquipe from "@/components/Cards/Forms/CardFormEquipe.vue";
  
  export default {
    components: {
        CardFormEquipe,
    },
  };
  </script>
  