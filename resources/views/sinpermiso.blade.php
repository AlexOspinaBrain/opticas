<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                  <div class="p-6 sm:px-20 bg-white border-b border-gray-200" align="center">
    
                    <x-jet-authentication-card-logo />
                    <br>
                    <div class="alert alert-primary" role="alert">
                        <span>No tiene permiso de ingresar a esta opción, verifique sus permisos con el administrador de usuarios.</span>
                      </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
