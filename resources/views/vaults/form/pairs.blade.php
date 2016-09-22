<div id="app">
    <pairs-table :list="{{ $vault->pairs }}"></pairs-table>
</div>

<p class="help-block">
    You can use the next key bindings:
    <ul>
        <li>
            <strong>'user' or 'username':</strong>
            For the username
        </li>
        <li>
            <strong>'pass' or 'password':</strong>
            For the password encriptation
        </li>
        <li>
            <strong>'host', 'hostname', 'link', 'web' or 'website':</strong>
            For website link
        </li>
        <li>
            <strong>'db' or 'database':</strong>
            For database
        </li>
        <li>
            <strong>'mail', 'mailbox':</strong>
            For email vinculation
        </li>
    </ul>
</p>

<template id="pairs-table-template">
    <table class="table table-condensed table-striped table-hover">
        <thead>
            <tr>
                <th>{!! trans('vaults.key') !!}</th>
                <th>{!! trans('vaults.value') !!}</th>
                <th>{!! trans('vaults.comment') !!}</th>
                <th class="text-right"><a class="btn btn-primary btn-xs" @click="add"><i class="fa fa-plus-circle"></a></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(index, pair) in list" track-by="$index">
                <td><input type="text" name="pairs[@{{ index + 1 }}][key]" v-model="pair.key" class="form-control"></td>
                <td><input type="text" name="pairs[@{{ index + 1 }}][value]" v-model="pair.value" class="form-control"></td>
                <td><input type="text" name="pairs[@{{ index + 1 }}][comment]" v-model="pair.comment" class="form-control"></td>
                <td class="text-right" style="vertical-align: middle;">
                    <a @click="remove(pair)" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

@push('scripts')
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.13/vue.js"></script>
<script type="text/javascript">
// Vue.config.debug = true;

Vue.component('pairs-table', {
    template: '#pairs-table-template',
    props: ['list'],
    methods: {
        add: function () {
            this.list.push({ key: '', value: '', comment: '' });
        },
        remove: function (pair) {
            this.list.$remove(pair);
        }
    }
});

new Vue({ el: '#app' });
</script>
@endpush
