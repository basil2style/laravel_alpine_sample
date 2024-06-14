<html>
    <head>
        <title>Home</title>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    </head>
    <body>
        <h1>Home</h1>
        <div x-data="{ count: 0 }">
			<button @click="count = count + 1">Add</button>
			<span x-text="count">0</span>
		</div>

        <div x-data="{ open: false }">
            <button @click="open = true">Show More...</button>
     
            <ul x-show="open" @click.outside="open = false">
                <li><button wire:click="archive">Archive</button></li>
                <li><button wire:click="delete">Delete</button></li>
            </ul>
        </div>
       
        <div class="flex flex-col h-screen justify-center content-center">
            <div class="flex flex-col self-center px-8 pt-6 pb-8 max-w-7xl my-2 mb-4 bg-white rounded shadow-md" x-data="{person : {
                                  firstName: null,
                                  lastName: null,
                                  address: null,
                                  city: null
                                  }}" x-init="(async () => {
                                            const response = await fetch('https://jsonplaceholder.typicode.com/users/1')
                                            if (! response.ok) alert(`Something went wrong: ${response.status} - ${response.statusText}`)
                                            data = await response.json()
                                            person = {
                                                       name: data.name,
                                                       email: data.email,
                                                       address: data.address.street,
                                                       city: data.address.city
                                                       }
                                                       })()">
              <div class="mb-6 md:flex">
                <div class="px-3 mb-6 md:w-1/2 md:mb-0">
                  <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="name">
                    Name
                  </label>
                  <input x-model="person.name" class="block w-full px-4 py-3 mb-3 border rounded appearance-none bg-grey-lighter text-grey-darker border-red" required type="text" id="name">
                </div>
                <div class="px-3 md:w-1/2">
                  <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="email">
                    email
                  </label>
                  <input x-model="person.email" class="block w-full px-4 py-3 border rounded appearance-none bg-grey-lighter text-grey-darker border-grey-lighter" required type="email" id="email">
                </div>
              </div>
              <div class="mb-6  md:flex">
                <div class="px-3 mb-6 md:w-1/2 md:mb-0">
                  <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="address">
                    Address
                  </label>
                  <input x-model="person.address" class="block w-full px-4 py-3 border rounded appearance-none bg-grey-lighter text-grey-darker border-grey-lighter" required type="text" id="address">
                </div>
                <div class="px-3 md:w-1/2">
                  <label class="block mb-2 text-xs font-bold tracking-wide uppercase text-grey-darker" for="city">
                    City
                  </label>
                  <input x-model="person.city" class="block w-full px-4 py-3 border rounded appearance-none bg-grey-lighter text-grey-darker border-grey-lighter" required type="text" id="city">
                </div>
              </div>
              <div class="mb-2  md:flex flex justify-end">
                <button @click="(async () => {
                                              const response = await fetch('/api/update', {
                                                  method: 'POST',
                                                  body: JSON.stringify(person)
                                              })
                                              if (response.ok) alert('Updated Successfully!')
                                              else alert(`Something went wrong: ${response.status} - ${response.statusText}`)       
                                          })()" class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
                  Update Info
                </button>
          
              </div>
            </div>
          </div>
    </body> 
</html>