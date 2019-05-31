
<template>
    <div class="media post">
        <vote :model = "answer" name = "answer"></vote>

        <div class="media-body m-3">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea rows="10" v-model="body" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary" :disabled="isInvalid"> Update</button>
                <button class="btn btn-outline-secondary" @click.prevent="cancel" type="button"> Cancel</button>
            </form>
            <div v-else>
                <div v-html="body_html"></div>

                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">

                            <a v-if="authorize('modify',answer)" v-on:click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>

                            <a v-if="authorize('modify',answer)" v-on:click.prevent="destroy" class="btn btn-sm btn-danger">Delete</a>

                        </div>

                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 ">

                        <user-info :model = "answer" label="answered"></user-info>
                    </div>

                </div>
            </div>




        </div>
    </div>
</template>



<script>
    import Userinfo from "./Userinfo";
    import Vote from "./Vote";
    import modification from "../mixins/modification"
    export default {
        props:['answer'],
        mixins: [modification],
        data(){
            return {

                body: this.answer.body,
                body_html:this.answer.body_html,
                id:this.answer.id,
                questionId:this.answer.question_id,
                beforeEditCache : null,
            }
        },
        methods:{


            setEditCache(){

                this.beforeEditCache = this.body;

            },

            restoreFromCache(){

                this.body = this.beforeEditCache;

            },

            payload(){
                return {
                  body : this.body
                };
            },

            delete(){
                axios.delete(this.endpoint)
                    .then(({data}) => {
                        this.$toast.success(data.message,'Success',{
                            timeout:2000
                        });
                        this.$emit('deleted')
                    });
            }

        },

        computed: {
            isInvalid(){
             return this.body.length <10 ;
            },

            endpoint(){
                return `/questions/${this.questionId}/answers/${this.id}`;
            }
        },
        mounted() {
            console.log(window)
        },

        components :{
            Userinfo:Userinfo,
            Vote :Vote
        }
    }


</script>