<template>
    <header class="header">
          <ul class="header__menu nav nav-pills">
              <li class="nav-item">
                  <router-link
                      aria-current="page"
                      class="nav-link"
                      to="/">
                    Главная
                  </router-link>
              </li>
              <li>
              <router-link
                    aria-current="page"
                    class="nav-link"
                    :to="{
                    name: 'Thriller',
                    params: {
                       //parameter: ''
                    }
                    }">
                Триллеры
                </router-link>
              </li>
              <li>
              <router-link
                    aria-current="page"
                    class="nav-link"
                    :to="{
                    name: 'Drama',
                    }">
                Драмы
                </router-link>
              </li>
              <li>
              <router-link
                    aria-current="page"
                    class="nav-link"
                    :to="{
                    name: 'Comedy',
                    }">
                Комедии
                </router-link>
              </li>
              <li>
              <router-link
                    aria-current="page"
                    class="nav-link"
                    :to="{
                    name: 'Boeviki',
                    }">
                Боевики
                </router-link>
              </li>
              <li>
              <router-link
                    aria-current="page"
                    class="nav-link"
                    :to="{
                    name: 'Foreign',
                    }">
                Зарубежные
                </router-link>
              </li>
              <li>
              <router-link
                    aria-current="page"
                    class="nav-link"
                    :to="{
                    name: 'Adventures',
                    }">
                Приключения
                </router-link>
              </li>
              <li>
              <router-link
                    aria-current="page"
                    class="nav-link"
                    :to="{
                    name: 'Melodramy',
                    }">
                Мелодраммы
                </router-link>
              </li>
              <li>
              <router-link
                    aria-current="page"
                    class="nav-link"
                    :to="{
                    name: 'Fantastika',
                    }">
                Фантастика
                </router-link>
              </li>
              <li>
              <router-link
                    aria-current="page"
                    class="nav-link"
                    :to="{
                    name: 'Fentezi',
                    }">
                Фентези
                </router-link>
              </li>
              <li>
              <router-link
                    aria-current="page"
                    class="nav-link"
                    :to="{
                    name: 'Detective',
                    }">
                Детективы
                </router-link>
              </li>
              
          </ul>
      </header>
  </template>

<script>
</script>

<style scoped>
.header {
    width: 992px;
    margin: 0 auto;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>