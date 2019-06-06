




export default {
    data(){
        return{
            editing: false,

        }

    },

    methods : {
        edit(){

            this.setEditCache();
            this.editing = true;
        },

        cancel(){
            this.restoreFromCache();
            this.editing = false;
        },

        update () {
            console.log('updated'+this.dataurl);
            axios.put(this.endpoint, this.payload())
                .then(({data}) => {
                    this.body_html = this.editor.getHTML();
                    this.$toast.success(data.message, 'Success', {timeout:3000});
                    this.editing = false;

                })
                .catch(err => {
                    this.$toast.error(err.response.data.message, 'Error', {timeout:3000});

                });
        },
        destroy() {
            this.$toast.question('Are you sure about that?','Confirm',{
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Hey',
                message: 'Are you sure about that?',
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', (instance, toast) => {

                        this.delete();

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                    }, true],
                    ['<button>NO</button>', function (instance, toast) {

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                    }],
                ],
            });


        },

        setEditCache(){},
        restoreFromCache(){},
        payload(){},
        delete(){},
    }


}