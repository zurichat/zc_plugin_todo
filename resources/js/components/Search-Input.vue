<template>
    <label
      class="
        bg-gray-50
        rounded-lg
        
        border-2 border-gray-200
        p-2
        text-gray-300
        max-w-md
        flex
        justify-between
      "
      for="search"
    >
      <svg
        class="w-6 h-6 absolute ml-1"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
        ></path>
      </svg>
      <input
        type="text"
        name="search"
        placeholder="Search here"
        class="ml-8 bg-transparent text-black outline-none w-4/5"
      />
      <svg
        class="w-6 h-6 right-0 mr-2"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
        ></path>
      </svg>
    </label>

</template>
<script>
export default {
    name: 'Search-Input'
}
</script>