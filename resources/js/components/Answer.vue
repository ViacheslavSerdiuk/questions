
<template>
    <div class="media post">
        <vote :model = "answer" name = "answer"></vote>

        <div class="media-body m-3">
            <form v-if="editing" @submit.prevent="update">
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
            </form>
            <div v-else>
                <div v-html="body_html"></div>

                <div class="row">
                    <div class="col-4 mt-auto">
                        <div class="ml-auto">

                            <a v-if="authorize('modify',answer)" v-on:click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>

                            <a v-if="authorize('modify',answer)" v-on:click.prevent="destroy" class="btn btn-sm btn-danger">Delete</a>

                        </div>

                    </div>
                    <div class="col-5"></div>
                    <div class="col-3">

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
        props:['answer'],
        mixins: [modification],
        data(){
            return {
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
                body: this.answer.body,
                body_html:this.answer.body_html,
                id:this.answer.id,
                questionId:this.answer.question_id,
                beforeEditCache : null,
            }
        },

        created (){
            this.editor.setContent(this.body);

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
                  body : this.editor.getHTML()
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
            hljs.initHighlightingOnLoad();
        },

        components :{
            Userinfo:Userinfo,
            Vote :Vote,
            EditorMenuBar,
            EditorContent,
        }
    }


</script>