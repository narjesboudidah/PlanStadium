<template>
  <!-- Header -->
  <div
    class="relative md:pt-32 pb-32 pt-12"
    style="
      background-image: url('https://images.pexels.com/photos/12327672/pexels-photo-12327672.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
      background-position-y: 50%;
      background-size: cover;
      background-repeat: no-repeat;
      border-radius: 1rem;
      margin-top: 2rem;
      margin-right: 1rem;
      margin-left:  4.5rem;
    "
  >
    <div
      style="
        background-image: linear-gradient(310deg, #17ad37, #98ec2d);
        opacity: 20%;
        border-radius: 1rem;
      "
      class="absolute top-0 left-0 w-full h-full"
    ></div>
    <!-- Contenu de l'élément ici -->
    <div class="px-4 md:px-100 mx-auto w-full">
      <div>
        <!-- Card stats -->
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats
              statSubtitle="Nombre de users"
              statTitle="350,897"
              statIconName="fas fa-user"
              statIconColor="bg-emerald-550"
            />
          </div>
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats
              statSubtitle="Nombre de stades"
              statTitle="2,356"
              statIconName="fas fa-hockey-puck"
              statIconColor="bg-emerald-550"
            />
          </div>
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats
              statSubtitle="Nombre des equipes"
              statTitle="924"
              statIconName="fas fa-users"
              statIconColor="bg-emerald-550 "
            />
          </div>
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <card-stats
              statSubtitle="Nombre stes maintenance"
              statTitle="49,65"
              statIconName="fas fa-tools"
              statIconColor="bg-emerald-550 "
            />
            
          </div>
        </div>
        
      </div>
    </div>
  </div>
</template>

<script>
import CardStats from "@/components/Cards/CardStats.vue";

export default {
  components: {
    CardStats,
  },
};
</script>
<style scoped>
.min-h-screen-75 {
  height: calc(100vh - 0rem);
  min-height: 24rem;
}
</style>
