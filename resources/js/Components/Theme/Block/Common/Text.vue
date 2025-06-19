<script setup lang="ts">
defineOptions{
    name: 'BlockCommonText',
}

interface Props {
    block: Model.Block & PropsBlock
}

type PropsBlock = {
    content: {
        title?: string;
        text?: string;
    }
}
</script>
