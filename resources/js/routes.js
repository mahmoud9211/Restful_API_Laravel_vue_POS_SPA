
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget_password = require('./components/auth/forget_password.vue').default;
let logout = require('./components/auth/logout.vue').default;

let home = require('./components/home.vue').default;

let employees = require('./components/Employees/index.vue').default;
let employeesCreate = require('./components/Employees/create.vue').default;
let editEmployees = require('./components/Employees/edit.vue').default;

let suppliers = require('./components/Suppliers/index.vue').default;
let suppliersCreate = require('./components/Suppliers/create.vue').default;
let editSuppliers = require('./components/Suppliers/edit.vue').default;

let categories = require('./components/categories/index.vue').default;
let categoriesCreate = require('./components/categories/create.vue').default;
let editCategories = require('./components/categories/edit.vue').default;

let products = require('./components/products/index.vue').default;
let productsCreate = require('./components/products/create.vue').default;
let editProducts = require('./components/products/edit.vue').default;

let customers = require('./components/customers/index.vue').default;
let customersCreate = require('./components/customers/create.vue').default;
let editCustomers = require('./components/customers/edit.vue').default;

let expenses = require('./components/expenses/index.vue').default;
let expensesCreate = require('./components/expenses/create.vue').default;
let editExpenses = require('./components/expenses/edit.vue').default;

let stock = require('./components/stock/index.vue').default;
let editStock = require('./components/stock/edit.vue').default;









export const routes = [

  //Auth
    { path: '/login', component: login , name : 'login' },
    { path: '/register', component: register , name : 'register' },
    { path: '/forget/password', component: forget_password , name : 'forget_password' },
    { path: '/logout', component: logout , name : 'logout' },

  //home
    { path: '/', component: home , name : 'home' },

    //employees

    { path: '/employees', component: employees , name : 'employees' },
    { path: '/employees/create', component: employeesCreate , name : 'employeesCreate' },
    { path: '/employees/edit/:id', component: editEmployees , name : 'editEmployees' },

    //suppliers

    { path: '/suppliers', component: suppliers , name : 'suppliers' },
    { path: '/suppliers/create', component: suppliersCreate , name : 'suppliersCreate' },
    { path: '/suppliers/edit/:id', component: editSuppliers , name : 'editSuppliers' },

     //categories

     { path: '/categories', component: categories , name : 'categories' },
     { path: '/categories/create', component: categoriesCreate , name : 'categoriesCreate' },
     { path: '/categories/edit/:id', component: editCategories , name : 'editCategories' },

     //products

     { path: '/products', component: products , name : 'products' },
     { path: '/products/create', component: productsCreate , name : 'productsCreate' },
     { path: '/products/edit/:id', component: editProducts , name : 'editProducts' },

     //customers

     { path: '/customers', component: customers , name : 'customers' },
     { path: '/customers/create', component: customersCreate , name : 'customersCreate' },
     { path: '/customers/edit/:id', component: editCustomers , name : 'editCustomers' },

      //expenses

      { path: '/expenses', component: expenses , name : 'expenses' },
      { path: '/expenses/create', component: expensesCreate , name : 'expensesCreate' },
      { path: '/expenses/edit/:id', component: editExpenses , name : 'editExpenses' },

      //stock
      { path: '/stock', component: stock , name : 'stock' },
      { path: '/stock/edit/:id', component: editStock , name : 'editStock' },



     





    
    

  ]