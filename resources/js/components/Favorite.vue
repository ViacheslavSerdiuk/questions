<template>

    <a title="Click to mark as favorite question (Click again to undo)" :class="classes" @click.prevent="toggle">

        <i class="fas fa-star fa-2x"></i>
        <span class="favorites-count">{{ Count }}</span>
    </a>

</template>
<script>


    export default {
        props : ['question'],

        data(){
            return{

                isFavorited : this.question.is_favorited,
                Count : this.question.favorites_count,
                Id : this.question.id
            }
        },
        computed : {
            classes (){
                return[
                    'favorite',
                    'mt-2',
                    ! this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : '' ),
                ]
            },
            endpoint(){
                return `/questions/${this.Id}/favorites`;
            },
          /*  signedIn(){
                return window.Auth.signedIn;
            }*/

        },

        methods : {
            toggle(){
                if(!this.signedIn){
                    this.$toast.warning('Please login to favorite this question', 'Warning', {timeout:3000, position :'bottomLeft'});
                    return;
                }
                this.isFavorited ? this.destroy(): this.create();
            },
            destroy(){
                axios.delete(this.endpoint)
                    .then(res =>{
                        this.Count --;
                        this.isFavorited = false;
                    })
            },
            create(){

                axios.post(this.endpoint)
                    .then(res =>{
                        this.Count ++;
                        this.isFavorited = true;
                    }
                )
            }

        }
    }


</script>