<template>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-form-stade/>
      </div>
      
    </div>
  </template>
  <script>
  import CardFormStade from "@/components/Cards/Forms/CardFormStade.vue";
  
  export default {
    components: {
        CardFormStade,
    },
  };
  </script>
  