<template>
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <card-form-comp/>
      </div>
      
    </div>
  </template>
  <script>
  import CardFormComp from "@/components/Cards/Forms/CardFormComp.vue";
  
  export default {
    components: {
        CardFormComp,
    },
  };
  </script>
  