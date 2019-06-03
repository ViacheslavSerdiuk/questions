<answer :answer="{{$answer}}" inline-template>
<div class="media post">
<vote :model = "{{$answer}}" name = "answer"></vote>

    <div class="media-body m-3">
        <form v-if="editing" @submit.prevent="update">
            <div class="form-group">
                <textarea rows="10" v-model="body" class="form-control" required></textarea>
            </div>
            <button class="btn btn-primary" :disabled="isInvalid"> Update</button>
            <button class="btn btn-outline-secondary" @click.prevent="cancel" type="button"> Cancel</button>
        </form>
        <div v-else>
        <div v-html="bodyHtml"></div>
        <div class="row">
            <div class="col-4">
                <div class="ml-auto">

                    @can('update',$answer)
                        <a v-on:click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                    @endcan

                    @can('delete',$answer)
                        {{-- action="{{route('questions.answers.destroy',[$question->id,$answer->id]) --}}
                            <a v-on:click.prevent="destroy" class="btn btn-sm btn-danger">Delete</a>
                    @endcan

                </div>

            </div>
            <div class="col-4"></div>
            <div class="col-4 ">
             {{--   @include('shared._author',[
                'model' =>$answer,
                'label' => 'answered'
                ])--}}
                <user-info :model = "{{$answer}}" label="answered"></user-info>
            </div>

        </div>
        </div>




    </div>
</div>
</answer>

