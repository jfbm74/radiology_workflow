<div class="card">
    <div class="card-header">
        <h3 class="card-title">DATOS DE INGRESO</h3>
        
    </div>
    <div class="card-body">
        <div class="col">
            <div class="form-group">
                <div class="form-label">Atención Prioritaria</div>
                <label class="custom-switch">
                    <input type="checkbox" 
                            name="priority"                                                
                            @if ($admission->priority == 1)
                            value="1"
                            class="custom-switch-input" checked
                            @else
                            class="custom-switch-input"
                            @endif>
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">Prioritaria</span>
                </label>
            </div>
            
            <h3 class="form-label">Entrega de Resultados</h3>                              
            <div class="form-group">
                <div class="custom-switches-stacked">
                    <label class="custom-switch">
                        <input  type="radio" 
                                name="option" 
                                value="Acetato" 
                                @if ($admission->delivery == "Acetato")
                                    class="custom-switch-input" 
                                    checked
                                @else
                                    class="custom-switch-input" 
                                @endif
                                >
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Acetato</span>
                    </label>
                    <label class="custom-switch">
                        <input  type="radio"
                                name="option" 
                                value="Virtual" 
                                @if ($admission->delivery == "Virtual")
                                    class="custom-switch-input" 
                                    checked
                                @else
                                    class="custom-switch-input" 
                                @endif
                                    class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Virtual</span>
                    </label>
                    <label class="custom-switch">
                        <input  type="radio" 
                                name="option" 
                                value="Ambas" 
                                @if ($admission->delivery == "Ambas")
                                    class="custom-switch-input" 
                                    checked
                                @else
                                    class="custom-switch-input" 
                                @endif
                                class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Ambas</span>
                    </label>
                    <label class="custom-switch">
                        <input  type="radio" 
                                name="option" 
                                value="Papel" 
                                @if ($admission->delivery == "Papel")
                                    class="custom-switch-input" 
                                    checked
                                @else
                                    class="custom-switch-input" 
                                @endif
                                class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description">Solo Papel</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>Observaciones</label>
                <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" 
                          name="observations" 
                          id="textarea" 
                          rows="6"
                          placeholder="">{{$admission->obs}}</textarea>
                          
              </div>
              <div class="card-footer text-right">
                <a href="{{route('admission.index')}}" class="btn btn-primary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>                      
    </div>
</div>    