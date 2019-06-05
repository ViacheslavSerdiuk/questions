<template>
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>Your answer</h2>
                </div>
`
                <hr>

                <form @submit.prevent="create">

                    <div class="form-group">
                       <!-- <textarea v-model="body" class="form-control" required rows="7" name="body">


                        </textarea>-->
                        <!--<ckeditor :editor="editor" v-model="body" :config="editorConfig"></ckeditor>-->
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
                    </div>
                    <div class="form-group">
                        <button type="submit" :disabled="isInvalid" class="btn btn-lg btn-outline-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>


<script>

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

        props : ['questionId'],
        components: {
            EditorMenuBar,
            EditorContent,
        },

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
                body : '',

            }
        },

        computed : {

            isInvalid(){

                return !this.signedIn || this.editor.getHTML().length <20 ;

            }
        },

        methods : {

             create(){

                  axios.post(`/questions/${this.questionId}/answers`,{
                      body : this.editor.getHTML()
                      })
                      .then(({data}) =>{
                          this.$toast.success(data.message,'Success');
                          this.body = this.editor.getHTML();
                          this.editor.clearContent();

                          this.$emit('created',data.answer);


                      })
                      .catch(error =>{
                          this.$toast.error(error.responce.data.message)
                      })


            },


        }

    }

    </script>
