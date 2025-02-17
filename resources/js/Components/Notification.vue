<template>
    <div v-if="$page.props.flash.message" class="alert">
        {{ $page.props.flash.message }}
    </div>
</template>
<style scope>
.alert {
    padding: 10px;
    margin: 15px;
    position: absolute;
    z-index: 4;
    width: max-content;
    border-radius: 10px;
    color: var(--color-text);
    background-color: var(--color-background);
}
</style>
