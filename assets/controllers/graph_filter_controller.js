import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['button', 'filterInput'];

    connect() {
        console.log('GraphFilter controller connected!');
        console.log('Buttons found:', this.buttonTargets.length);
        console.log('FilterInput found:', this.filterInputTarget);
        this.updateActiveButton();
    }

    selectFilter(event) {
        console.log('selectFilter called!', event);
        const button = event.target.closest('button');
        console.log('Button:', button);
        if (!button) return;
        
        const filterValue = button.dataset.filterValue;
        console.log('Filter value:', filterValue);
        
        // Mettre à jour l'input et déclencher un événement
        this.filterInputTarget.value = filterValue;
        
        // Créer et déclencher un événement personnalisé pour LiveComponent
        const event2 = new CustomEvent('live-component:update', {
            detail: { property: 'activeFilter', value: filterValue },
            bubbles: true
        });
        this.filterInputTarget.dispatchEvent(event2);
        
        // Déclencher input et change
        this.filterInputTarget.dispatchEvent(new Event('input', { bubbles: true }));
        this.filterInputTarget.dispatchEvent(new Event('change', { bubbles: true }));
        
        // Mettre à jour l'affichage des boutons
        this.updateActiveButton();
    }

    updateActiveButton() {
        const currentValue = this.filterInputTarget.value;
        console.log('Current filter value:', currentValue);
        this.buttonTargets.forEach(button => {
            if (button.dataset.filterValue === currentValue) {
                button.classList.add('active');
            } else {
                button.classList.remove('active');
            }
        });
    }
}


