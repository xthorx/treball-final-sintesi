export class Drink {
    private _id: number;
    private _titol: string;
    private _autor: string;
    private _privadesa: string;

    constructor() {
    }

    get id(): number {
        return this._id;
    }
    get titol(): string {
        return this._titol;
    }
    get autor(): string {
        return this._autor;
    }
    get privadesa(): string {
        return this._privadesa;
    }


    set id(id: number) {
        this._id = id;
    }
    set titol(titol: string) {
        this._titol = titol;
    }
    set autor(autor: string) {
        this._autor = autor;
    }
    set privadesa(privadesa: string) {
        this._privadesa = privadesa;
    }
}
