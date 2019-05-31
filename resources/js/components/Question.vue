<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form class="card-body" v-if="editing" @submit.prevent="update">

                    <div class="card-title">
                        <input type="text"  class="form-control  form-control-lg" v-model="title">
                    </div>
                    <hr>


                    <div class="media">

                        <div class="media-body">
                            <div class="form-group">
                                <textarea rows="10" v-model="body" class="form-control" required></textarea>
                            </div>
                            <button class="btn btn-primary" :disabled="isInvalid"> Update</button>
                            <button class="btn btn-outline-secondary" @click.prevent="cancel" type="button"> Cancel</button>
                        </div>
                    </div>
                </form>
                <div class="card-body" v-else>

                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2> {{title}}</h2>
                            <div class="ml-auto">
                                <a href="/questions" class="btn btn-outline-secondary">Back to all questions</a>
                            </div>

                        </div>
                    </div>
                    <hr>


                    <div class="media">


                        <vote :model = "question" name = "question"></vote>

                        <div class="media-body">
                            <div v-html="body_html"></div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">

                                        <a v-if="authorize('modify',question)" v-on:click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>

                                        <a v-if="authorize('deleteQuestion',question)" v-on:click.prevent="destroy" class="btn btn-sm btn-danger">Delete</a>

                                    </div>

                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">

                                    <user-info :model="question" label="Asked"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

    import Userinfo from "./Userinfo";
    import Vote from "./Vote";
    import modification from "../mixins/modification";

export default {
    props : ['question'],
    mixins: [modification],
    data(){
        return{

            body: this.question.body,
            title : this.question.title,
            body_html : this.question.body_html,
            beforeEditCache : null,
            id: this.question.id
        }
    },

    methods : {
        setEditCache(){
            this.beforeEditCache =
                {
                    body : this.body,
                    title : this.title,
                };
        },

        restoreFromCache(){
            this.body = this.beforeEditCache.body;
            this.title = this.beforeEditCache.title;
        },

        payload(){
            return {
                body: this.body,
                title: this.title
            }
        },

        delete(){
            axios.delete(this.endpoint)
                .then(({data}) => {
                    this.$toast.success(data.message,'Success',{
                        timeout:2000
                    })
                });

            setTimeout(()=>{
                window.location.href ="/questions"
            },2000);
        },




    },


    computed: {
        isInvalid(){
            return this.body.length <10 || this.title.length <10;
        },

        endpoint(){
            return `/questions/${this.id}/`;
        }
    },
    components :{
        Userinfo:Userinfo,
        Vote :Vote
    }

}

</script>