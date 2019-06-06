<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form class="card-body" v-if="editing" @submit.prevent="update">

                    <div class="card-title">
                        <input type="text"  class="form-control  form-control-lg" v-model="title">
                    </div>
                    <hr>

                    <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
                        <div>
                            <button :class="{ 'is-active': isActive.bold() }" @click.prevent="commands.bold">
                                Bold
                            </button>
                            <button :class="{ 'is-active': isActive.heading({ level: 2 }) }" @click.prevent="commands.heading({ level: 2 })">
                                H2
                            </button>
                            <button
                                    class="menubar__button"
                                    :class="{ 'is-active': isActive.code_block() }"
                                    @click.prevent="commands.code_block"
                            >
                                <></button>

                        </div>
                    </editor-menu-bar>
                    <div class="question-create">
                        <editor-content :editor="editor"/>
                    </div>
                    <button class="btn btn-primary" :disabled="isInvalid"> Update</button>
                    <button class="btn btn-outline-secondary" @click.prevent="cancel" type="button"> Cancel</button>
                    <!--<div class="media">

                        <div class="media-body">
                            <div class="form-group">
                                <textarea rows="10" v-model="body" class="form-control" required></textarea>
                            </div>
                            <button class="btn btn-primary" :disabled="isInvalid"> Update</button>
                            <button class="btn btn-outline-secondary" @click.prevent="cancel" type="button"> Cancel</button>
                        </div>
                    </div>-->
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

    import javascript from 'highlight.js/lib/languages/javascript'
    import css from 'highlight.js/lib/languages/css'
    import php from 'highlight.js/lib/languages/php'

    import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
    import {
        Bold,
        Heading,
        CodeBlockHighlight,
        Code
    }  from 'tiptap-extensions'

export default {
    props : ['question'],
    mixins: [modification],
    data(){
        return{
            editor: new Editor({
                extensions : [
                    new Bold(),
                    new Heading(),
                    new CodeBlockHighlight({
                        languages: {
                            javascript,
                            css,
                            php
                        },
                    }),
                    new Code(),
                ],
                content : '<p></p><p></p>'
            }),
            dataurl:this.question.data_url,
            body: this.question.body,
            title : this.question.title,
            body_html : this.question.body_html,
            beforeEditCache : null,
            id: this.question.id
        }
    },
    created (){
        this.editor.setContent(this.body);

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
                body: this.editor.getHTML(),
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
   /* mounted() {
        hljs.initHighlightingOnLoad();
    },
*/
    computed: {
        isInvalid(){
            return this.body.length <10 ;
        },

        endpoint(){
            return this.dataurl
           // return `/questions/${this.id}/`;
        }
    },
    components :{
        Userinfo:Userinfo,
        Vote :Vote,
        EditorMenuBar,
        EditorContent,

    }

}

</script>