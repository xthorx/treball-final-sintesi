export class Categoria {
    private _id: number;
    private _nom: string;

    constructor() {
    }

    get id(): number {
        return this._id;
    }
    get nom(): string {
        return this._nom;
    }


    set id(id: number) {
        this._id = id;
    }
    set nom(nom: string) {
        this._nom = nom;
    }
}
