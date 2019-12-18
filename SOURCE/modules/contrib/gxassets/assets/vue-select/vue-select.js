Vue.component('v-select2', {
    template: '<select :placeholder="placeholder" class="vue-select2 form-control"><option selected disabled>{{placeholder}}</option><option v-for="(name, key) in options" :value="key" :selected="key == selected">{{name}}</option></select>',
    props: ['options', 'selected', 'placeholder'],
    model: {
        prop: 'selected',
        event: 'change'
    },
    mounted: function () {
        var vm = this;
        this.placeholder = typeof (this.placeholder) == 'undefined' ? "Vui lòng chọn" : this.placeholder;
        $(this.$el).select2({ 'placeholder': { id: "", placeholder: this.placeholder } });
        $(this.$el).on('change', function (e) {
            vm.$emit('change', vm.$el.value);
        })
    },
    updated: function () {
        $(this.$el).val(this.selected);
        $(this.$el).trigger('change');
    },
    beforeDestroy: function () {
        $(this.$el).off().select2('destroy');
    }
});

Vue.component('v-select2-single', {
    props: ['options', 'value'],
    template: `
        <select class="form-control">
            <slot></slot>
        </select>`,
    mounted: function () {
        var vm = this
        $(this.$el)
            .select2({ data: this.options })
            .val(this.value)
            .trigger('change')
            .on('change', function () {
                vm.$emit('input', $(this).val())
            })
    },
    watch: {
        value: function (value) {
            if ([...value].sort().join(",") !== [...$(this.$el).val()].sort().join(","))
                $(this.$el).val(value).trigger('change');
        },
        options: function (options) {
            $(this.$el).select2({ data: options })
        }
    },
    destroyed: function () {
        $(this.$el).off().select2('destroy')
    }
})

Vue.component('v-select2-multiple', {
    props: ['options', 'value'],
    template: `
        <select multiple class="form-control">
            <slot></slot>
        </select>`,
    mounted: function () {
        var vm = this
        $(this.$el)
            .select2({ data: this.options })
            .val(this.value)
            .trigger('change')
            .on('change', function () {
                vm.$emit('input', $(this).val())
            })
    },
    watch: {
        value: function (value) {
            if ([...value].sort().join(",") !== [...$(this.$el).val()].sort().join(","))
                $(this.$el).val(value).trigger('change');
        },
        options: function (options) {
            $(this.$el).select2({ data: options })
        }
    },
    destroyed: function () {
        $(this.$el).off().select2('destroy')
    }
})