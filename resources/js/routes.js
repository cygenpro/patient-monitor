import AddPatient from "./components/Doctor/AddPatient";
import DoctorHome from "./components/Doctor/DoctorHome";
import PatientHome from "./components/Patient/PatientHome";

let routes = [];

if( window.authUser ) {
    if( window.authUser.is_doctor ) {
        routes = [
            {path: '/', component: DoctorHome},
            {path: '/add-patient', component: AddPatient},
            {path: '/patient/:id', component: DoctorHome}
        ];
    } else {
        routes = [
            {path: '/', component: PatientHome},
            {path: '/doctor/:id', component: PatientHome}
        ]
    }
}

export {routes};
