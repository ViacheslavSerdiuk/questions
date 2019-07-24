<template>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <img :src="avatar"> <span style="float: right">{{name}}</span>
                    </div>
                    <div class="modal-footer">
                        Answers : {{answers}}
                        Questions : {{questions}}
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
        props:['user'],
        data(){
            return {
                name: this.user.name,
                avatar : this.user.avatar,
                questions : this.user.count_questions,
                answers : this.user.count_answers

            }
        }


    }



</script>
