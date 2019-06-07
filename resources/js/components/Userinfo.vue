<template>
    <div >
    <span class="text-muted">{{ postDate }}</span>
    <div class="media">
        <a :href="user.url" class="pr-2"> <img :src="user.avatar" class="w-50" style="object-fit: none;
    object-position: center;
    height: 50px;
    width: 75px;"></a>
        <div class="media-body mt-auto">
            <a :href="user.url">{{user.name}}</a>
        </div>

    </div>
    </div>
</template>
<script>
    export default {
     props:['model','label'],

     computed: {
        postDate(){
            return this.label + " " + this.model.created_date;
        }
     },

        data(){
         return {
             user: this.model.user
         }
        }

    }
</script>