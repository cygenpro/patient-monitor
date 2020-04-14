import AddPatient from "./components/Doctor/AddPatient";
import App from "./components/App";
import DoctorHome from "./components/Doctor/DoctorHome";

export const routes = [
    {path: '/', component: DoctorHome},
    {path: '/add-patient', component: AddPatient}
];
