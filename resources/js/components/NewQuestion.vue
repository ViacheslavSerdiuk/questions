<template>

    <div>


        <form @submit.prevent="create">
            <div class="form-group">


            </div>
            <div class="form-group">
                <label>Title</label>

                <div class="card-title">
                    <input type="text" class="form-control  form-control-lg" v-model="title">
                </div>
            </div>


                <label>Category</label>
                <div class="media-body">
                    <div class="form-group ">
                        <select v-model="selectedCategory" class="browser-default custom-select">
                            <option v-for="category in categories" v-bind:value="category.id">{{category.title}}
                            </option>
                        </select>
                    </div>
                </div>


            <label>Text</label>


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




                <button class="btn btn-primary" :disabled="isInvalid">Submite</button>


        </form>
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

        props : ['categories'],


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

                title:'',
                body:'',
                categories:this.categories,
                selectedCategory:'',
            }
        },

        components: {
            EditorMenuBar,
            EditorContent,
        },

        methods : {

            create(){

                axios.post(`/questions`,{
                    title : this.title,
                    body : this.editor.getHTML(),
                    category_id : this.selectedCategory
                })
                    .then(({data}) =>{

                        this.$toast.success(data.message,'Success');
                        setTimeout(()=>{
                            window.location.href ="/questions"
                        },1000);
                    })
                    .catch(error =>{
                        this.$toast.error(error.responce.data.message)
                    })
            },
        },
        computed: {
            isInvalid(){
                return this.title.length <5 || this.editor.getHTML().length <20 ;
            },

        },


    }


</script>