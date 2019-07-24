<template>
    <div @mousemove="hidemodal">
    <span class="text-muted">{{ postDate }}</span>
    <div class="media">
         <div  @mouseover="actionmodal" >
        <a :href="user.url" class="pr-2" > <img :src="user.avatar" class="w-50" style="object-fit: none;
    object-position: center;
    height: 50px;
    width: 75px;"></a>
         </div>
        <div class="media-body mt-auto">
            <a :href="user.url">{{user.name}}</a>
        </div>

    </div>

        <info-modal ref="modal" :user="user"></info-modal>
    </div>
</template>
<script>
    import Userinfo from "./Userinfo";
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
        },
        methods: {
            hidemodal(){

                let element = this.$refs.modal.$el;

                  $(element).modal('hide')
            },
            actionmodal(){
                let element = this.$refs.modal.$el;

                $(element).modal({
                    show:true,
                    backdrop:false
                })
            },
        },
        components :{
            Userinfo:Userinfo,
        }

    }
</script>